
<div class="container">
    

    <button class="button" onClick="window.location.href = 'https://apria.artez.nl/submissions/rererererererererererereparasite/index.html'"><span class="icon">Home</span></button>
    <button class="button" onClick="window.location.href = 'https://apria.artez.nl/submissions/rererererererererererereparasite/read.html'"><span class="icon">Read</span></button>
    <button class="button" onClick="window.location.href = 'https://apria.artez.nl/submissions/rererererererererererereparasite/legend.html'"><span class="icon">Legend</span></button>
    <button class="button" onClick="window.location.href = 'https://apria.artez.nl/submissions/rererererererererererereparasite/bibliography.html'"><span class="icon">Bibliography</span></button>
    <button class="button" onClick="window.location.href = 'https://apria.artez.nl/submissions/rererererererererererereparasite/biography.html'"><span class="icon">Biography</span></button>
    <button class="button" onClick="window.location.href = 'https://apria.artez.nl/submissions/rererererererererererereparasite/code.html'"><span class="icon">Code</span></button>
    <p id="readingtime">Average Reading Time: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;minutes</p>
    <p id="stats"></p>
    <div id="publication"></div>

<script>
        // Retrieve debug parameters from URL
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const debug = urlParams.get('debug');
    
        // Covid related
        const capacityIC = urlParams.get('capacityIC') > 0 ? urlParams.get('capacityIC') : 319; // At 319 occupied IC beds (infected words) the lockdown starts
        const startDuplicate = capacityIC;                                      // When 319 infections have taken place, the duplication of letters can happen
        const rna = ['a', 'g', 't', 'c', 'u', 'i'];                             // The letters that can be transformed

        // Chances what happens after infection (percent)
        const percentRecoveries = urlParams.get('percentRecoveries') > 0 ? urlParams.get('percentRecoveries') : 72;
        const percentPartlyRecoveries = urlParams.get('percentPartlyRecoveries') > 0 ? urlParams.get('percentPartlyRecoveries') : 25;
        const percentDeaths = urlParams.get('percentDeaths') > 0 ? urlParams.get('percentDeaths') : 3;
        const recoverMin = urlParams.get('recoverMin') > 0 ? urlParams.get('recoverMin') : 7;
        const recoverMax = urlParams.get('recoverMax') > 0 ? urlParams.get('recoverMax') : 22;
        const recoverPartlyMin = urlParams.get('recoverPartlyMin') > 0 ? urlParams.get('recoverPartlyMin') : 7;
        const recoverPartlyMax = urlParams.get('recoverPartlyMax') > 0 ? urlParams.get('recoverPartlyMax') : 22;
        const recoverDeathMin = urlParams.get('recoverDeathMin') > 0 ? urlParams.get('recoverDeathMin') : 7;
        const recoverDeathMax = urlParams.get('recoverDeathMax') > 0 ? urlParams.get('recoverDeathMax') : 28;
        
        // To calculate reading time
        const lettersPerMin = 2880;

        // Settings on the length of the day and speed of changes
        var r = urlParams.get('r') > 0 ? urlParams.get('r') : 1.27;             // The reproduction value
        var rDate = new Date('2020-09-24');
        const dayLength = urlParams.get('daylength') > 0 ? urlParams.get('daylength') : 2000; // The length of a day in milliseconds
        const interval = 100;                                                   // The amount of milliseconds that the function has to be called
        const timeslotMax = dayLength / interval;                               // The amount of timeslots in a day

        // Asynchronous AJAX call to PHP to retrieve the live reproduction value from public website with JSON output
        jQuery.ajax({  
            type: "GET",
            url: "https://apria.artez.nl/submissions/rererererererererererereparasite/reproductionvalue.php",
            success: function(data){
                if (data['success'] && !urlParams.get('r')) {
                    if (data['rt'] > 1) {
                        r = data['rt'];
                        rDate = data['rtdate'];
                    } else {
                        r = 1.27;                                               // If live R < 1, then R of 24-09 (1.27)
                        rDate = new Date('2020-09-24');
                    }
                }
            }
        });

        // Other global variables
        var startReadDay;
        var startReadDay2;
        var partInfect = 0;
        var partRecover = 0;
        var day = 0;                                                            // Counter for the amount of days
        var countRecovered = 0;
        var countDead = 0;
        var countPartlyRecovered = 0;
        var lockdown = "";
        var endLockdownPer = 0.5;
        var endLockdown = endLockdownPer * capacityIC;
        var counterWordsTotalInfected = 0;                                      // Counter for the amount of words that ever has been infected

        var remainder = 0;
        // Put the publication on the screen and start
        var publication = getPublication();
        document.getElementById("publication").innerHTML = insertStyles(publication);
        start();
        
        function start() {
            // Set the variables
            var timeslot = 0;                                                   // Counter for the timeslot of the day
            var counterWordsInfectedOnDay = 0;                                  // Counter for the amount of words to infect on the day
            var counterWordsRecoveredOnDay = 0;                                 // Counter for the amount of words to recover on the day
            var amount;                                                         // Counter for the amount of words to be infected (or recoverd) in a timeslot   
            var counterActiveInfection = 0;                                     // Counter for the infected words
            var pointerInfectedWord = 0;
            var wordId;                                                         // Original id (number) of the word to infect in the publication
            var wordsOriginal = publication.split(" ");                         // Original words of publication for recovery purposes
            var wordsInfected = publication.split(" ");                         // Words of publication that will be infected
            var wordsIdInfected = new Array;                                    // Array with the id's of the words that can be infected
            var recovery = new Array;                                           // Array with the recovery-type and day corresponding with id of word (id: type, day)
            var recoveryDay = new Array;                                        // Array for the day with the id and type of the words that will recover (count: id, type)
            var amountToInfectOnDay = 1;                                        // Start with 1 infected word
            var amountToInfectOnDayDecimal = 1;
            var amountToRecoverOnDay = 0;
            startReadDay = new Date();                                          // Startdatetime to display in debug info
            startReadDay2 = Date.now();                                         // Startdatetime to calculate duration
            
            // Scan which words will be infected (which have the rna letters)
            wordsIdInfected = scanWords(wordsOriginal);

            // Infect the next words in the timeslot and run timeslot every couple milliseconds (interval)
            var x = setInterval(function() {    
                // STEP 1: INFECT  -- If not all IC beds are occupied, continue infection, otherwise start lockdown
                if (lockdown != "LOCKDOWN") {
                    // Calculate the amount of words to infect in this interval/timeslot
                    amount = amountInfectionsInterval(counterWordsInfectedOnDay, timeslot, amountToInfectOnDay);

                    // Infect the next couple of words in this timeslot and define its recovery
                    while (amount-- > 0) {
                        if (pointerInfectedWord < wordsIdInfected.length) {
                            wordId = wordsIdInfected[pointerInfectedWord];      // Look-up the ID of the next word to be infected
                            wordsInfected[wordId] = infectWord(wordsOriginal[wordId], counterActiveInfection, 0);   // Infect the word and add it to the array
                            recovery[pointerInfectedWord] = selectRecovery();   // Define the recovery of this just infected word
                            pointerInfectedWord++;                              // Go to the next word that can be infected
                            counterActiveInfection++;                           // Go to the next word of the publication
                            counterWordsInfectedOnDay++;                        // Go to the next word for this day
                            counterWordsTotalInfected++;                        // Count the words that ever has been infected                          
                        }
                    }
                }

                // STEP 2: RECOVER  -- If on this day words are planned to recover (=recover / die / partly recover)
                if (amountToRecoverOnDay > 0) {
                    amount = amountRecoveriesInterval(counterWordsRecoveredOnDay, timeslot, amountToRecoverOnDay);  // Calculate the amount of words to recover in this interval/timeslot

                    while (amount-- > 0) {                  
                        recoverWord(recoveryDay, wordsOriginal, wordsInfected, wordsIdInfected, counterActiveInfection);    // Start recovery
                        counterActiveInfection--;                               // Make IC bed available
                        counterWordsRecoveredOnDay++;                           // Count the words recovered on day
                    }
                }
                
                if (counterActiveInfection > capacityIC) lockdown = "LOCKDOWN"; // Check if there needs to be a lockdown
                if (counterActiveInfection < endLockdown) lockdown = "";
    
                // STEP 3: UPDATE SCREEN  -- Put the results on the screen
                updateResult(wordsInfected, day+1, timeslot+1, pointerInfectedWord, counterWordsTotalInfected, counterWordsInfectedOnDay, amountToInfectOnDay, counterActiveInfection, wordsIdInfected.length, counterWordsRecoveredOnDay, amountToRecoverOnDay);

                // STEP 4: FINISH UP  -- Get ready for next day or timeslot
                if (++timeslot == timeslotMax) {                                // If it's the end of the day
                    counterWordsInfectedOnDay = 0;                              // Start with first word of the new day
                    counterWordsRecoveredOnDay = 0;

                    timeslot = 0;                                               // Start with first timeslot of the new day
                    partInfect = 0;                                             // Part counter for the amount of words to infect
                    partRecover = 0;                                            // Part counter for the amount of words to recover
                    day++;                                                      // Go to the next day                   

                    // Already count the amount of words that will be infected the next day
                    if (lockdown == "") {                                               
                        amountToInfectOnDay = amountInfectionsDay(day, recovery);
                        if (counterActiveInfection == 0 && amountToInfectOnDay == 0 && day < 100) amountToInfectOnDay = 1; // To prevent script from stopping
                    } else {
                        amountToInfectOnDay = 0;                                // In lockdown there will be no new infections
                    }
                    
                    // Already prepare the words that need to be recovered on the next day
                    recoveryDay = recoveryDayWords(day, recovery);              // Create an array with words to recover on the next 'day'
                    amountToRecoverOnDay = recoveryDay.length;
                }
                
                // Stop processing and clear interval when all words have been infected and there are no active infections anymore
                if (counterWordsTotalInfected >= wordsIdInfected.length && counterActiveInfection == 0) { 
                    updateResult(wordsInfected, day+1, timeslot+1, pointerInfectedWord, counterWordsTotalInfected, counterWordsInfectedOnDay, amountToInfectOnDay, counterActiveInfection, wordsIdInfected.length, counterWordsRecoveredOnDay, amountToRecoverOnDay);
                    clearInterval(x);                                           // Stop processing
                }
            }, interval);
        }
                
        function amountInfectionsDay(day, recovery) {
            var amountToInfectOnDay = remainder;
            var average = 0;
            
            // Calculate current average length of infected period
            for (var i = 0; i < recovery.length; i++) {
                average+=recovery[i][1]
            }
            average = average / recovery.length;
            
            // Loop through the infected words and add their 'infectiondayrate'
            for (var i = 0; i < recovery.length; i++) {
                if (day >= recovery[i][2] && day <= recovery[i][3]) {           // If the recovery date is still in the future
                    amountToInfectOnDay += (r * recovery[i][1] / average) / recovery[i][1]; // Dayrate is the R divided by the recoverytime (in days), corrected for the average length of recovery period (12)
                }
            }

            remainder = amountToInfectOnDay - Math.round(amountToInfectOnDay);
            if (remainder < 0) remainder = 0;
            return Math.round(amountToInfectOnDay);
        }
    
        function scanWords(wordsOriginal) {
            var wordsIdInfected = new Array;
            var k = 0;

            // Scan which words will be infected (which have the rna letters) and save the number of the word
            for (var i = 0; i < wordsOriginal.length; i++) {
                var checkword = wordsOriginal[i].split("");                     // Take a word and split it per letter
                for (var j = 0; j < checkword.length; j++) {
                    if (rna.indexOf(checkword[j]) != -1) {                      // Find the place in the word which corresponds with one of the rna letters
                        wordsIdInfected[k] = i;                                 // Save the original number of the word
                        k++;
                        j = checkword.length;                                   // Skip to the end of the word
                    }
                }
            }
            return wordsIdInfected;
        }
    
        function amountInfectionsInterval(counterWordsInfectedOnDay, timeslot, amountToInfectOnDay) {
            var amountToInfectOnInterval;

            if (timeslot < timeslotMax-1) {                                     // If it's not the last timeslot                        
                if (amountToInfectOnDay >= timeslotMax) {                       // If there are more to infect than timeslots,then at least 1 per timeslot, not needed to calculate parts
                    amountToInfectOnInterval = Math.round((amountToInfectOnDay - counterWordsInfectedOnDay) / (timeslotMax - timeslot)); // The remainaing amount of the day devided by the remaining timeslots
                }
                else {
                    partInfect += amountToInfectOnDay / timeslotMax;            // Keep adding until it's 1
                    amountToInfectOnInterval = (partInfect >= 1 ? 1 : 0);       // If one or more is gathered, than use it 
                    partInfect -= amountToInfectOnInterval;                     // and than substract 1 from the part, to have the remainder for the next step.
                }
                    
                if (counterWordsInfectedOnDay + amountToInfectOnInterval > amountToInfectOnDay) {   // In case of rounding issues: When total is more than amountToInfectOnDay, then limit amount to the remaining (till amountToInfectOnDay)
                    amountToInfectOnInterval = amountToInfectOnDay - counterWordsInfectedOnDay;
                }
            } else {
                amountToInfectOnInterval = amountToInfectOnDay - counterWordsInfectedOnDay; // The last interval of the day: do only the remainder to fix rounding issues
            }

            return amountToInfectOnInterval;
        }
        
        function infectWord(word, counterActiveInfection, partly) {
            var j;
            var position;
            var rna_replace = new Array;
            var rnd;
            var lettersWord = word.split("");
            
            // Transform the letters of the word, one by one 
            for (j = 0; j < lettersWord.length; j++) {
                // Search for the letters that can be infected
                position = rna.indexOf(lettersWord[j].toLowerCase());               //  Find the place in the array of the letter under investigation (if applicable)

                // If it's a letter that has to be changed, decide if the letter needs to be replaced or duplicated
                if (position != -1) { 
                    if (partly == 0 || (partly == 1 && Math.random() < 0.3)) {
                        if (counterWordsTotalInfected < startDuplicate || Math.random() < 0.5) {    //  If random integer=0 (50%), or if amountToInfectOnDay is too low to duplicate:
                            // Replace letters
                            rna_replace = rna.slice(0);                             // Copy the rna items to rna_replace
                            rna_replace.splice(position, 1);                        // Remove the letter from the array, so it cannot be choosen
                            rnd = Math.floor(Math.random() * rna_replace.length);   // Random number to select one of the remaining letters
                            if (lettersWord[j] == lettersWord[j].toUpperCase()) {
                                lettersWord[j] = rna_replace[rnd].toUpperCase();    // Replace letter with the selected letter in the word
                            } else {
                                lettersWord[j] = rna_replace[rnd];
                            }
                        } else {                                                    // 50%: If the random result is >= 0.5:
                            // Duplicate letters
                            lettersWord[j] = lettersWord[j].repeat(Math.floor(Math.random() * 14) + 8); // Put a couple of the same letter (8-21) back in the array.
                        }
                    }
                }
            }
                            
            return lettersWord.join("");
        }

        function selectRecovery() {
            // Already define the recovery results for this word
            var recovery = [];
            var possibility = Math.floor(Math.random() * 100);                                                          // Random integer between 0 and 100 to randomly choose recovery time

            if (possibility >= 0 && possibility < percentRecoveries) {                                                  // In percentRecoveries% of the cases:
                recovery[0] = "recovery";                                                                               // Fully recover
                recovery[1] = recoverMin + Math.floor(Math.random() * (recoverMax - recoverMin));                       // Randomly between Min and Max days
            } else if (possibility >= percentRecoveries && possibility < percentRecoveries + percentPartlyRecoveries) { // In percentPartlyRecoveries% of the cases:
                recovery[0] = "partlyRecovery";                                                                         // Keeps an active infection for always, only partly recover 
                recovery[1] = recoverPartlyMin + Math.floor(Math.random() * (recoverPartlyMax-recoverPartlyMin));       // Randomly between Min and Max days 
            } else if (possibility >= percentRecoveries + percentPartlyRecoveries && possibility < percentRecoveries + percentPartlyRecoveries + percentDeaths) {   // In percentDeath% of the cases: 
                recovery[0] = "death";                                                                                  // Will disease
                recovery[1] = recoverDeathMin + Math.floor(Math.random() * (recoverDeathMax-recoverDeathMin));          // Randomly between Min and Max days
            }

            recovery[2] = day;                                                                                          // The day that the infection started
            recovery[3] = recovery[1] + day;                                                                            // The day that the infection is over
            return recovery;
        }

        function recoveryDayWords(day, recovery) {
            var recoveryDay = new Array; //[[], []];

            // Make an array with words that needs to be recovered on this day
            for (var j = 0; j < recovery.length; j++) {
                if (recovery[j][3] == day) {
                    recoveryDay.push([j, recovery[j][0]]);
                }
            }
            return recoveryDay;
        }
                
        function amountRecoveriesInterval(kR, timeslot, amountToRecoverOnDay) {
            var amountRecover;
            
            if (timeslot < timeslotMax-1) {                                         // If it's not the last timeslot                        
                if (amountToRecoverOnDay >= timeslotMax) {
                    amountRecover = Math.round((amountToRecoverOnDay - kR) / (timeslotMax-timeslot));
                } else {
                    partRecover += amountToRecoverOnDay / timeslotMax;              // Keep adding until it's 1

                    if (partRecover >= 1) {                                         // If it's 1, than use it 
                        amountRecover = 1;
                        partRecover = 0;
                    } else {
                        amountRecover = 0;
                    }
                }
                
                if (kR + amountRecover > amountToRecoverOnDay) {                    // When total is more than day amount, then limit amount to the remaining 
                    amountRecover = amountToRecoverOnDay - kR;
                }
            } else {
                amountRecover = amountToRecoverOnDay - kR;                          // The last interval of the day: do only the remainder to fix rounding issues
            }

            return amountRecover;
        }

        function recoverWord(recoveryDay, wordsOriginal, wordsInfected, wordsIdInfected, counterActiveInfection) {
            // Select a random word from the array to recover
            var m = 0; //Math.floor(Math.random() * recoveryDay.length);
            var j = recoveryDay[m][0];                                              // This is the id of the array with (only) infected words
            var wordId = wordsIdInfected[j];                                        // Look-up the id of the word within publication
            
            switch (recoveryDay[m][1]) {
                case 'recovery':
                    wordsInfected[wordId] = wordsOriginal[wordId];
                    countRecovered++;
                    break;
                case 'partlyRecovery':
                    wordsInfected[wordId] = infectWord(wordsOriginal[wordId], counterActiveInfection, 1);   // Infect the word and add it to the array
                    countPartlyRecovered++;
                    break;
                case 'death':
                    wordsInfected[wordId] = "&nbsp;".repeat(wordsOriginal[wordId].length + 1);  
                    countDead++;
                    break;
            }
            
            recoveryDay.splice(m, 1);                                               // Remove the recovered day from the array
        }
    
        function updateResult(wordsInfected, day, timeslot, pointerInfectedWord, counterWordsTotalInfected, counterWordsInfectedOnDay, amountToInfectOnDay, counterActiveInfection, maxInfected, counterWordsRecoveredOnDay, amountToRecoverOnDay) {
            // Put the results on the screen
            var readingtime = wordsInfected.join(" ").length / lettersPerMin;
            
            document.getElementById("readingtime").innerHTML = "<p style=\"font-size:180%;\">Average Reading Time " + displayReadingtime(readingtime) + " minutes</p>";

            document.getElementById("stats").innerHTML = "\
            <B>CONSTANTS</B><BR>\
            R: " + r + " (" + displayDate(rDate) + ") | Capacity IC: " + capacityIC + " | End lockdown (% of IC): " + endLockdownPer*100 + "% | LettersPerMin: " + lettersPerMin + "<BR>\
            Recover: " + percentRecoveries + "% (" + recoverMin + "-" + recoverMax + " days) | Die: " + percentDeaths + "% ("+ recoverDeathMin + "-" + recoverDeathMax + " days) | Partly recover: " + percentPartlyRecoveries + "% (" + recoverPartlyMin + "-" + recoverPartlyMax + " days)<BR><BR>\
            Total infections: " + counterWordsTotalInfected + " |  Now contagious: " + counterActiveInfection + "<BR>\
            Recovered: " + countRecovered + " | Dead: " + countDead + " | Partly recovered: " + countPartlyRecovered + "<BR>\
            <B><BR>"+lockdown+"</B>";

            
            if (debug) {
                document.getElementById("stats").innerHTML += "<BR>Daylength: " + dayLength + " ms <BR>\
                Start: " + checkTime(startReadDay.getHours()) + ":" + checkTime(startReadDay.getMinutes()) + ":" + checkTime(startReadDay.getSeconds()) + " | Duration: " + ((Date.now() - startReadDay2)/1000).toFixed(1) + " seconds<BR>\
                Day: " + day + " | Timeslot: " + timeslot + "/" + timeslotMax + " | Word pointer: " + pointerInfectedWord + " | Words infected on day: " + counterWordsInfectedOnDay + "/" + amountToInfectOnDay + " | Words recovered on day: " + counterWordsRecoveredOnDay  + "/" + amountToRecoverOnDay +  " | Infected words: " + counterActiveInfection + "/" + maxInfected;
            }

            document.getElementById("publication").innerHTML = insertStyles(wordsInfected.join(" "));

            document.body.style.background = ((lockdown == "LOCKDOWN") ? '#FFA6A6' : '#FFFF00');    
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function displayDate(d) {
            var d = new Date(d);
            return d.toLocaleDateString();
        }
        
        function displayReadingtime(r) {
            var min = Math.floor(r);
            var sec = Math.round((r - min) * 60);
            var sMin = min; //(min < 10 ? "0"+min : min);
            var sSec = (sec < 10 ? "0"+sec : sec);
            return sMin + ":" + sSec
        }
        
        function getPublication() {
            return "<p #01> Publication Infected by Reader: </p>\
            <p #02> REREREreREREreREREREREREParasite </p>\
            <p #03> By Saskia Isabella Maria Korsten, based upon a dialogue with Sem&#226; Bekirovi&#263;, and with technical support from Anonymous. </p>\
            <p #04> Time is elastic. </p>\
            <p #05> -   Carlo Rovelli </p>\
            <p #06> Dear reader, if you are reading this you have clicked on the 'Read' button, thus infecting this publication with a virus. </p>\
            <p> This publication is the record of an associative dialogue between Sem&#226; Bekirovi&#263; and Saskia Isabella Maria Korsten. We started this ongoing dialogue in April 2020, during the lockdown as a response to the first wave of the SARS CoV-19 outbreak in the Netherlands. The dialogue was carried out by sending a Word file back and forth to each other, sometimes expanded with additional information via email, text messages or transcribed telephone conversations, which have found their way back into this document. It is a document that shows our reflections on, associations with and reactions to each other's input. Along the way, some lines of thought were deleted or relocated, and others were developed further; some theoretical notions were also added to the document. With every new version, one more 'RE' was added to the title of the document. The focus of our conversation became the experience of time during the COVID-19 pandemic. Using code, Korsten transformed the dialogue into a COVID-19 clock, based on parameters gathered from the variables of the pandemic and coupled with variables for time perception while reading the publication. 'Time is elastic,' is what Carlo Rovelli says in The Order of Time, and this is exactly what we concluded from our conversations. The dialogue served as input for an artistic contribution where the form of the publication (the code infecting it) works together with the final text, demonstrating its conceptual building process. The references in the text refer to sources which one can find through the 'Bibliography' button at the top of this page. </p>\
            <p> The code script operating inside this publication is based on and written with the variables of the characteristics of the COVID-19 outbreak in mind. The explanation of the variables can be found in the Legend of Variables (click on 'Legend' at the top of the page). The code activates a virus that spreads exponentially and shows what happens if a lockdown is imposed to stop the spread. It does so by analogy of what happens inside a host when it is invaded by a virus. Cells (in this case 'letters') are duplicated and mutate, and the cells inside the host (in this case 'words') react by inverting this process through reverse scripting. </p>\
            <p> This publication itself functions as a clock and a visualization of elastic time in itself. The code for this 'Publication-functioning-as-a-Clock' was designed by Saskia, with invaluable technical support from Anonymous. It takes the average reading time as its basis. The reader can always see the clock at the top of this page, together with some constantly changing numbers, denoting a set of variables. From the moment of infection, the average reading time starts to increase, since letters are duplicated or replicated, causing a time delay in reading. When too many words become infected, the code applies a lockdown, during which some words recover and fewer words are infected. The average reading time will decrease again. This rhythm of speeding up and slowing down causes the clock to alternate between different average reading times. You as reader will physically experience this alternation as you are dogged by the infection. This immediately makes the elastic quality of time visual. </p>\
            <p> Legend:<br /><#07>Red - Sem&#226; <#08><br />\
            <#09> Purple - Saskia <#08><br />\
            <#10> Green - external sources <#08><br />\
            <#11> Black - indicating previous works by Sem&#226; and publications by Saskia <#08></p>\
            <p #12><#09> So, by reading this publication, the reader becomes part of it? As we are all globally entangled in the same COVID-19 pandemic, we are showing this entanglement on a small scale by bringing together the reader and the text as a relational construct in a literal sense. </p>\
            <p #12><#09> According to physicist Karen Barad, <#08>\
            <#10> 'objectivity is a matter of accountability to marks on bodies' ( Barad, Meeting the Universe Halfway, 340). <#08>\
            <#09> The one observing is the one actually engaging in the phenomena observed and is simultaneously part of them: </p>\
            <#10> '[o]bjectivity, then, is about being accountable and responsible about what is real' (340). </p>\
            <p#12><#09> Albert Einstein previously introduced an observer as part of the observed. He transcended Newton's absolute time by introducing relativity when he insisted that time is what is shown by a clock. With this clock, he introduced the observer as the essence of the situation. <#08>\
            <#10> '[Time is] considered measurable by a clock (ideal periodic process) of negligible spatial extent. The time of an event taking place at a point is then defined as the time shown on the clock simultaneous with the event' (Einstein 39-46). <#08>\
            <#09> Einstein goes further by presenting a revolutionary picture of space and time, showing that the time experienced by a clock depends on how fast it is moving - as the speed of a clock increases, the rate at which it ticks decreases. This phenomenon is called time dilation. Quantum physicist Carlo Rovelli explains how a clock on a table and another on the ground run at different speeds: <#08>\
            <#10> \'Which tells the time? The question is meaningless. We might just as well ask what is most real - the value of sterling in dollars or the value of dollars in sterling. There are two times that change relative to each other. Neither is truer than the other. But there are not just two times. Times are legion: a different one for every point in space\' (Rovelli, Time is Elastic). <#08>\
            <#09> According to Rovelli, we must speak about local time rather than 'time.' </p>\
            <p #12> In a telephone conversation we discussed notions of time and the virus. We spoke about Rovelli's ideas on time. </p>\
            <p #13> Rovelli, for instance, states that all of reality is interaction. We live for a hundred years, but suppose we lived a billion years. A stone would be just a moment at which some sand assembled and then dissembled, so it's just a momentary assemblage of sand. Interaction is always in between, a coming together, but if there is only interaction and no things (since all things turn out to be interactions themselves, but just on a different timescale), interaction is taking place between interactions, like pieces of music without an instrument resonating in endless feedback loops. If we cannot talk about the origin of the sound, what is left is to talk about the frequencies, melodies, loudness and intervals. </p>\
            <p #12> What is the interaction with the virus, in what timescale does it resonate with us? </p>\
            <p #13> Recognizing the effect rather than the source, we are always lagging behind. </p>\
            <p #12> Unless it is not about recognizing but experiencing, being part of it? </p>\
            <p #06> About <I>4'33\"</I> by John Cage, excerpt from an article by Saskia: </p>\
            <p #06> The beginning of each part was marked by closing the lid of the piano and the end by opening the lid. The piece is a composition of chance in which every incidental sound like someone coughing, or fidgeting on a chair, or a car passing by, becomes integrated in the performance. All these chance noises were measured exactly within the real timeframe, within the duration of 4 minutes and 33 seconds, by the sound of each second ticking away on his stopwatch. Each performance of <I>4'33\"</I> not only comprises different performance choices, but also different sounds captured within the duration of the performance. In this work, duration is put forward as <b>the</b> characteristic of music. (Korsten, Repeat Revolution) </p>\
            <p #12> The lid of the piano, orchestrated by a stopwatch, functions as a clock in this piece. It is not so much about the exact measurement of time (since Cage did not mind if the performance was shorter or longer than 4 minutes and 33 seconds), it was about being confronted by the simple passage of time and what happens during it. It concentrated the experience of 'duration actually passing'. </p>\
            <p #12><#09> I transcribed the part of Rovelli's lecture where he speaks about Quantum Mechanics. He says that time fluctuates: A-to-B is also B-to-A. <#08>\
            <#10> 'Just forget time completely it is an approximate notion, a local notion (only in our lives practical, not on a larger scale, not common in the Universe). Just like notions like 'up' and 'down' (that does not work in space either). No time does not mean no movement. Something frozen does not move when time passes. Things happen but not ordered in time (there is no director for the orchestra). Everything that moves can be used as a clock' (Rovelli, \"The nature of Time\"). <#08>\
            <#09> Great idea for a work in this publication, think about moving things that can work as a clock? To use as a time reference in the times of the virus outbreak or to measure the difference in the experience of time happening simultaneously, living together in a house with four people and having the same amount of time to do homework with children, do your job, your partner does his job, etc., coupled with the feeling of time coming to a halt, everybody inside, fewer cars on the street, no more rushing through the supermarket, etc. Rovelli states that time is relative, how do other things change or move relative to your chosen 'clock'? <#08></p>\
            <p #12> Now, in quantum mechanics, scientists are even working on a method to show quantum time dilation by moving one clock as if it were travelling at two different speeds simultaneously: a quantum 'superposition' of speeds (Dartmouth College). </p>\
            <p #12><#09> From a phone call between Sem&#226; and Saskia: <#08>\
            <#07> Sem&#226; is working on a piece about biological time. She asks herself whether we have a time organ, one that creates our sense of time. Every living being, from a human being to a single-celled amoeba, has some sort of internal clock that synchronizes with an external clock. For example, our metabolism is a clock because it takes a certain time for us to digest our food, but we cannot separate this mechanism from external data that we process, like the rhythm of the sun, which can seriously mess up our digestive system. In the book Your Brain is a Time Machine, Dean Buonomano says that time does not exist but is felt. It remains a philosophical maze, since you cannot simply prove this, but there is no life without time perception. Rovelli also says that if you move faster, time goes quicker, and if you are lower down (relative to the earth), time goes quicker than when you are higher up. Everything that has a cycle is a clock; the only difference with a real clock is not the clockwork of the clock, but how it is interpreted. </p>\
            <p #12> Another interesting notion about time is the fact that the Earth's rotation is slowing down ever so slightly, taking a longer time to complete one full turn, gradually making the solar day longer. NASA keeps track of this slowing down, which has led to an extra second, or 'leap' second, added at midnight on June 30, 2012 (Zubritsky). </p>\
            <p #13> During the first COVID-19 lockdown around March 2020, scientists found that the reduction of noise (far less heavy traffic, fewer trains, fewer factory engines) has caused a decrease in vibrations of the earth's crust, resulting in less movement of the earth (Lin). Would this have an effect on time as well, following NASA or quantum mechanics? </p>\
            <p #12> What happens when you take a day off, refusing to move along with the world? Guido van der Werve took this question literally, in his work 'Nummer negen (The day I didn't turn with the world)' (2007), and left for the North Pole, where he spent 24 hours on the axis of the world (see link in bibliography). Since Van der Werve only moved a tiny bit every second, he probably experienced a longer day (according to Rovelli) than others. The axis of the world as a clock... </p>\
            <p #12> If we were to make a COVID-19 clock, then what would the variables be? Are we working with seconds, minutes and hours? Or are we, just like in Cage's <I>4'33\"</I>, actually making a new clockwork with other indicators, such as two weeks of quarantine, 2.5 months of staying inside, not getting together with more than three people, keeping 1.5 metres away from people, incubation time, 1:3 degree of contamination, maximum occupation rate for intensive care units, what are the variables? Or should we specifically look at the data of the virus itself to derive a clock from that? The data in this case being how fast the virus spreads through the body, how many particles there are in your breath, how high your fever is, the code of the virus, the amount of time the virus will survive on a non-animal host, how fast the virus can spread in a country, a city, a continent? Maybe I perceive time differently in different conditions? Maybe faster, because of the simultaneous activities taking place in a household where everybody is in lockdown? Maybe slower, because of postponed contacts with relatives and friends? Maybe the rhythms of birds laying an egg and strawberries that are ready to be plucked have remained the same, in contrast with the human experience of not being able to pluck strawberries because of the lockdown, and having the sense that time is standing still while the strawberries are rotting? Or simply a clockwork derived from the scientific data of the virus; the code? </p>\
            <p #13><#07> What I was thinking is that due to industrialization, we have gone from all different kinds of clocks to one clock. For example, before clocks were invented, we used the sounds of certain animals in the morning as time indicators, or the sun, and after the invention of the clock, it took a long time before clocks were synchronized (this only happened when the railways were developed). Now, in the first weeks (April 2020) of quarantine, we seem to have become aware of other rhythms again. For example, due to having more time on my hands, I have become aware of specific bird sounds in the morning. This was also facilitated by the lack of car traffic in my street because of the lockdown, of course. An imaginary 'Covid composition' could be one of silence between repetitive markers (birdsong, church bells, Zoom conversations) - very much like the Cage piece described above. On the topic of music, I just read about a group of scientists who made the virus into a musical composition by translating the structure of its famous spike protein into sound. <br /><#08>\
            <#10> 'The sounds you hear-the chiming bells, the twanging strings, the lilting flutes-all represent different aspects of the spikelike protein that pokes from the virus' surface and helps it latch onto unsuspecting cells. Like all proteins, the spikes are made of combinations of amino acids. Using a new technique called sonification, scientists from the Massachusetts Institute of Technology assigned each amino acid a unique note in a musical scale, converting the entire protein into a preliminary musical score' (Venugopal). <#08></p>\
            <p #12> Then there is the idea of the subjective perception of time, time being the scaffolding of one's experience and behaviour, albeit an unsteady and subjective one. Emotions, music, events have the power to speed time up or slow it down in one's experience of it. This is the field of neuroscience. In the last couple of months, a few studies have been done to explain the way one perceives time as expanding and contracting like an accordion. In one study, evidence is found for a connection between time perception and the mechanism that helps us learn through rewards and punishments via levels of dopamine, a neurotransmitter. When one receives an unexpected reward, for instance, one gets a rush of this chemical, which teaches one to continue pursuing that behaviour in the future. But dopamine also affects one's perception of time in contradictory manners. Increasing dopamine speeds up an animal's internal clock, leading it to overestimate the passage of time. In contrast, other studies have found that dopamine compresses events and makes them seem more fleeting; still others have uncovered both effects, depending on context (Cepelewicz). </p>\
            <p #12> We seem to have a lot of input by now on the concept of elastic time, but we do need more input on the variables causing the COVID-19 infection in order to build the code that will infect our text. </p>\
            <p #13><#07> I looked up on the Internet how the virus enters our body undetected. The virus uses its spikes to infiltrate and replicate. Its reproduction system runs like a tiny factory. It is a bit of a system within a system, which functions like  a Trojan horse. <#08>\
            <#10> 'The spikes protrude from the surface of the virus and resemble a crown, or corona in Latin. Coronaviruses use their spikes to infiltrate living cells. When the conditions are right, the virus enters. Once inside, the coronavirus enlists the infected cell to produce the parts it needs: RNA and proteins. First, the virus commandeers the cell's machinery into making tools that can copy coronavirus RNA in bulk. The copying process occurs in a double-membrane compartment that keeps the virus hidden from the cell. Some of the RNA copies are packaged into the next generation of viruses. Other copies are used to tell the cell how to make viral proteins, including the ones that will encase the RNA. These proteins are made and assembled in the part of the cell that serves as a factory, warehouse and delivery system. A copy of the original viral RNA is corralled into a section of the membrane that's embedded with newly made viral proteins. When the RNA-enclosed membrane pinches shut, a new virus is formed' (Lu). <#08></p>\
            <p #12> So, this is how the mutuality of host and virus works, the virus becomes part of us... </p>\
            <p #13> How strange that we distil a sense of self out of all these entities and processes that we are made up of. </p>\
            <p #06><#11> About the notion of a partaker, excerpt from an article by Saskia (Korsten, \"Partaker Agency\"): <#08><br />\
            <#10> 'the idea of a person as an individual following from the lineage from the individual as a fixed element in a given larger whole towards the idea of \"The Individual\" as fixed in himself. Against these fixations, Dr. Dorner points to the personal individual as partaker in the \"general process of life\" and as a \"special contributor to it.\" This union of partaker and contributor describes the enduring work of the artist' (Dorner 10).  <#08></p>\
            <p #13> Physically (confined to the home, but also in the case of people being sick), as well as mentally and economically, we seem to have come to a halt. In our attempt to control the virus through lockdown, we are partaking in the fight against the virus by standing still. The moment we became hosts of the virus, we became aware that we are not the active agents here but have been largely reduced to passive matter. We have been hijacked by this tiny string of proteins. At the same time, a lot of people did not have the option of staying inside during quarantine; not everybody had the same opportunities to escape the virus. This resonates with the protests for equality that are happening right now. Many people were forced to work under conditions that were far from ideal during the last three months. Some of us suddenly found ourselves with more time, while other people were forced to work hard in unsafe conditions. </p>\
            <p #12> Just how will the COVID-19 pandemic affect one's perception of time? When a negative image, let's say an angry face on the screen, gives us a feeling of 'time dragging', what happens with the negative emotions regarding the uncertainties associated with the pandemic and the restrictions of a lockdown? Will this in fact influence how we perceive time as dragging (Li and Yuen)? </p>\
            <p #12> By standing still, staying at home, not seeing people, keeping a safe distance, we refrain from action, since otherwise we would contribute to the spread of the virus. Moving means life for the virus; by standing still, will kill it. </p>\
            <p #12> Time, according to Rovelli, does not exist in physics as we humans experience it; it is rather the domain of psychology or neuroscience, for instance (Rovelli, \"The Nature of Time\"). He goes on to state that time is relative; it is about how things change or move relative to your chosen 'clock', and he explains that time has an emotional component. That's why this publication functions as a clock showing how one might experience time during a COVID-19 outbreak. Time seems to slow down during lockdowns when one is confined to the house. Simultaneously, I experience a speeding up of time, looking at the figures in the statistics showing exponential growth in a short period of time. I can almost literally feel the virus approaching quickly while I am keeping as still as possible, moving as little as possible. Time is expanding and contracting at the same time, leaving me to feel confused, dazed, unstable. </p>\
            <p #12><#09> Slavoj Zizek on Covid-19: <#08> \
            <#10> 'In the grand order of things we are just a species without special treatment, we have a personal interest in small fun things, suffering from a blindly replicating virus' (Verschuer). <#08></p>\
            <p #13> Do we host 'aliens' in our bodies? Can code be an alien? An alien without a body? We only differ from other species because of code (DNA/RNA). </p>\
            <p #12> Viruses can't reproduce by themselves. They contain instructions on how to copy themselves but lack the tools and supplies to do it. That's why viruses have two jobs: invade living cells and turn them into virus-making factories. </p>\
            <p #13><#07> Following this line of thought, I came across Marc van Elburg's PARASITE Zine, all about parasitism, and I will quote part of it here: <#08>\
            <#10> 'We are all symbionts. 56% of our bodies consists of non-human cells, and we have at least 150 times more microbial genes than human genes. Symbiosis is in the nature of the ecosystem and therefore even doing nothing will bring about symbiotic relations. But this project addresses the active agents in the relation, and parasitism is the mark of the activist in any symbiosis. In a parasitic world, a parasite is not an entity with some clearly identifiable properties, but something highly ambiguous that evades any clear-cut definition and attempts at purification. There is a reality to which the word 'parasite' refers, but it is not that of a completely independent entity. On the contrary, the concept strongly connects to what comes into existence with its use and to the practice of naming' (Elburg). </#08>\
            <#07> Inspired by this zine, I gave our document its first name, 'Parasite', which you started adding 'REs' to, as a kind of parasite of its own.  </#08></p>\
            <p #12> What I like about this 'REreREreRE...' is that it is a temporal thing in itself. It displays the time elapsed between two or more responses; it indicates a process rather than a fixed result. </p>\
            <p #06><#11> About Karen Barad's notion on responsibility, excerpt from an article by Saskia (Korsten, \"Partaker Agency\"): <#08><br />\
            <#10> 'How matter starts to \"matter\"' (Barad, Posthumanist Performativity). <#08>\
            <#11> All the agencies participating hold a certain responsibility, so to speak, towards the end result of the participation. For the non-human agencies, it might be strange to speak of responsibility. The same goes for terms such as collaboration and participation. Symbiosis might be a more appropriate term. In the symbiosis, each acting component plays a crucial part. <#08></p>\
            <p #12><#09> Reading this publication is engaging with it, initiating its disintegration and witnessing its resurrection into something new. Inside the text of the publication another text is operational, the code. This second text does not consider the original meaning of the text itself to be of value but regards this text as mere letters and words with which it can perform calculations and measurements. Together, the first and second text, through the interference of the reader, become a new text. In Barad's \"Meeting the Universe Halfway\", <#08>\
            <#10> 'Phenomena [...] exist only as a result of, and as part of, the world's ongoing intra-activity, its dynamic and contingent differentiation into specific relationalities' (353). <#08>\
            <p #12><#09> I recognize a link between the fear of touching and contagion during the pandemic and some of your pieces (Bekirovi&#263;, <I>Every Atom, Kubus and Traces)</I>: <br />\
            <I>Every Atom belonging to me as good belongs to you</I> (2017) <br />\
            <I>Kubus 02</I> (2017) <br / >\
            <i>Traces I and II</I> (2016) <#08><br / >\
            <#09> In <I>Every Atom belonging to me as good belongs to you</I>, you use wallpaper glue which, you discovered, contain animal bones. You made a patch of glue light up under UV light. These bone atoms are inside human products and we come in contact with them on a daily basis. In <I>Kubus 02</I> you asked factory members to make an acrylic cube and asked them not to clean the cube. With fingerprint powder, you put on display all the fingers that touched the cube as it was being made. You take a similar approach in the <I>Traces</I> pieces. You dusted flea market objects with fingerprint powder and also visualized the 'handling' of these objects by different persons over time. In these works, you researched the traces that humans leave behind on objects. They literally leave invisible atoms behind through fingerprints. Overlapping fingerprints originate from time when one person touches the same spot as the person before them. That way, complete strangers are sharing their atoms with each other, which holds a perverted connection to the way one nowadays has to wear gloves and disinfect one's hands at any place where there could be an exchange of atoms. </#08></p>\
            <p #13> The body as material </p>\
            <p #13><#07> It seems that the virus does not have random effects. There seems to be some sort of genetic factor, shown in a study of identical twins with the same symptoms taken from the Covid-19 symptom tracker app. </#08>\
            <#10> '\"This disease is very weird, the way it has a very different presentation in the population in different people – what we are showing is that it isn't random,\" Prof Tim Spector said. \"It is not mainly due to where you live or who you have seen; a lot of it is something innate about you\"' (Davis). </#08></p>\
            <p #13><#07> I was reminded of a remark by Susanne Langer in one of your articles. <#08>\
            <#11> About Langer's notion of rhythm, excerpt from an article by Saskia (Korsten, \"Repeat Revolution\"): Imitating either oneself or others, care should be taken to imitate structure, not form (also structural materials and structural methods, not formal materials and formal methods), disciplines, not dreams; thus one remains <#08>\
            <#10> 'innocent and free to receive anew with each Now-moment a heavenly gift' (Langer 64). <#08>\
            <#11> Langer then goes on to state that breathing is the most perfect exhibit of physiological rhythm: <#08>\
            <#10> 'as we release the breath we have taken, we build up a bodily need of oxygen that is the motivation, and therefore the real beginning, of the new breath' (Langer 127). <#08>\
            <p #09> This beautifully matches the fear of breathing during the corona pandemic because of the risk of infection (either of becoming infected or of spreading the virus). We have a bodily need for oxygen, but this breath can be fatal. <#08></p>\
            <p #06><#11> About breathing, a work by Sem&#226;: <#08><br />\
            <#07> I once made an art piece about (not) breathing in collaboration with a free diver, it is called Borrowed Time (2015). <#08></p>\
            <p #12> Could it be an idea to take 'breathing' as a starting point for a COVID-19 clock?  </p>\
            <p #12> We moved away from these physiological variables for a COVID clock and focused on the way RNA editing resembles the scripting of code. The way a host counters a virus is by attacking it in its own language, using RNA editing to invert replications and mutations. The language of this editing, working with transcriptomes, resembles the way programming works, with scripts and calculations. This is how I came up with the idea of infecting the publication itself with a virus similar to COVID-19, and involving the reader in the work. The first idea was to make the publication disintegrate in front of one's eyes. The clock principle, then, was just to create a simple countdown until no more words were left to read. Later, while I was building the code and reading more about notions of subjective time-perception, I came upon the idea of using the average reading time coupled with the variables of the pandemic. This would render a more nuanced and dynamic relation between reading and time perception, which is now built into the code. This meant another way of perceiving time entered the equation, the technological temporality of code and calculations. </p>\
            <p #12><#09> In this publication, contagiousness will be coupled to yet another characteristic of an epidemic, namely that it spreads exponentially. This exponentiality is very hard to grasp for human beings who, as journalist Malcolm Gladwell put it in his influential book The Tipping Point, are <#08>\
            <#10> 'gradualists, our expectations set by the steady passage of time' (Gladwell 13, 14). <#08>\
            <#09> Gladwell uses the example of the folding of a piece of paper to visualize exponentiality: <#08><br />\
            <#10> 'I give you a large piece of paper, and I ask you to fold it over once, and then take that folded paper and fold it over again, and then again, and again, until you have refolded the original paper 50 times. How tall do you think the final stack is going to be? In answer to that question, most people will fold the sheet in their mind's eye, and guess that the pile would be as thick as a phone book or, if they're really courageous, they'll say that it would be as tall as a refrigerator. But the real answer is that the height of the stack would approximate the distance to the sun. And if you folded it over one more time, the stack would be as high as the distance to the sun and back. This is an example of what in mathematics is called a geometric progression. Epidemics are another example of geometric progression: when a virus spreads through a population, it doubles and doubles again, until it has (figuratively) grown from a single sheet of paper all the way to the sun in fifty steps' (Gladwell 11). <#08>\</p>\
            <p #12> The problem with exponentiality is that one cannot see the point of no return coming. In the beginning phase of a virus outbreak, nothing much seems to happen. The progress in the beginning goes gradually and slowly and has a tipping point, when it suddenly increases enormously. In hindsight one can analyze it, but it is very hard to see it coming, and that makes it very hard to act rationally in advance. Another problem is that to turn the tide, it is not enough to simply restore the situation as it was before. For instance, to restore the ice caps, one has to bring the temperature down much lower than it was originally. Visualizing the exponentiality of the COVID-19 outbreak is at the core of this publication. The experience of time is seen not as a gradually passing flow, but as an entity with its own agency, moving slowly at the beginning of an outbreak and speeding up enormously as the infections grow exponentially. The dawdling of governmental institutions before implementing COVID-19 restrictions clearly shows how uneasy we are with this 'unnatural' exponentiality. </p>\
            <p #12><#09> Gladwell explains exponentiality as a trait of epidemics that is incompatible with the human experience of time as gradually passing at a predictable pace. The code inside this publication works within a technological temporality, made to mimic the temporality of the exponentiality of a virus outbreak. Philosopher of Technology Bernard Stiegler couples the technological process of becoming-temporal-object to informatic calculation.  <#08>\
            <#10> 'Different analogic and numeric identities systematically temporalize everything that is retained (as the selected) in a new configuration of the elements validating all event-ization' (Stiegler 188). <#08>\
            <#09> Designing the experience of subjective time inside the code of the text is a highly mathematic process which I could only really grasp the consequences of by running the code in html once in a while to see it working. In all these experiments, it struck me how the exponentiality hits quite unexpectedly. Every time, it provoked a rush of adrenaline as I tried to read with the virus dogging me. The irreconcilable incongruity of the abstractness of the code and the physical outcome shows two completely different realms dealing with the same variables. </p>\
            <p #06> A thought on repetition, excerpt from an article by Saskia: <br />\
            It has become clear that repetition is hardly ever literal and actually holds performative powers (Korsten, \"Repeat Revolution\"). </p>\
            <p #12><#09> Philosopher Michael Marder has compared the viral activity of host cells to computer programmes. He says, <#08>\
            <#10> 'One aspect of viral activity is to infiltrate and to transcribe the texts of host cells and computer programs. Another is to replicate itself as widely as possible. In the social media universe, both aspects are actually coveted: When a photograph, a video, a joke or a story is shared, quickly spreading among internet or cellphone users, it is said to go viral. A high rate of viral content's replication is not sufficient, as it needs to make an impact, transcribing, as it were, the social text it has infiltrated. The ultimate goal is to assert one's influence through a widely disseminated image or story and wield that power. Going viral introduces a fair degree of complexity into our affective relation to viruses: feared, when we become their targets and possible hosts; desired, when they are our instruments for reaching a sizable audience' (Marder, \"The Corona Virus is Us\"). </#08>\
            <#09> I can completely understand his warning that in dealing with exponentiality, one has to be extra careful with consequences that might surpass our human sense of scope. </p>\
            <p #12> By now, at the end of this publication, the question is: what is there still left to read? Will this sentence be unaltered when you, the reader, arrive at it? The whole population, all the words in this text are infected, recovered, partly recovered or deceased, and the average reading time has finally stabilized to a predicted average, which is not the same as the prediction at the start. The prediction has been subject to change during the infection and made a leap to a huge predicted average reading time at the height of the infection. By that time, this clock was running like mad and you were probably rushing through the text, or you discovered that you could click on the 'read' button again, or refresh the page, in order to buy yourself a bit more time. The feeling that this rushing gave you is also part of the goal of this publication's focus on the notion of time. Your perception of running out of time is directly and physically related to the topic of this APRIA issue. </p>\
            <p #12> Tick tock </p>\
            <p #13> Tick tock </p>";
        }

        function insertStyles(txt) {
            txt = txt.replace(/#01/g, "style=\"font-size:150%;text-align:left;\"");
            txt = txt.replace(/#02/g, "style=\"font-size:150%;text-align:center;\"");
            txt = txt.replace(/#03/g, "style=\"text-align:center;\"");
            txt = txt.replace(/#04/g, "style=\"text-align:center;font-style:italic;\"");
            txt = txt.replace(/#05/g, "style=\"text-align:right;\"");
            txt = txt.replace(/#06/g, "id=\"previous\"");           // Black
            txt = txt.replace(/#07/g, "span id=\"sema\"");          // Span Red 
            txt = txt.replace(/#08/g, "/span");
            txt = txt.replace(/#09/g, "span id=\"saskia\"");        // Span Purple
            txt = txt.replace(/#10/g, "span id=\"external\"");      // Span Green
            txt = txt.replace(/#11/g, "span id=\"previous\"");      // Span Black
            txt = txt.replace(/#12/g, "id=\"saskia\"");             // Purple
            txt = txt.replace(/#13/g, "id=\"sema\"");               // Red
            txt = txt.replace(/#14/g, "style=\"\"");
            txt = txt.replace(/#99/g, "style=\"\"");
            txt = txt.replace(/#99/g, "style=\"\"");
            return txt;
        }
    </script>


</div>