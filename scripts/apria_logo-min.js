var fixture_def_circle={friction:.8,restitution:.3,density:1},fixture_def_char={friction:.4,restitution:.1,density:.1},gravity=14,motor_speed=-.03;const R2D=180/Math.PI,TWO_PI=2*Math.PI,X=0,Y=1;function map(t,e,i,r,o){return r+(t-e)/(i-e)*(o-r)}planck.internal.Settings.maxPolygonVertices=48,function(){for(var t=planck,e=t.Vec2,i=t.World({gravity:e(0,gravity)}),r=[{name:"A",width:17.2,height:29.6,x:7.7,y:33.9,cx:16.3,cy:48.7,vecs:[[19.498,33.889,24.941,63.515,20.037,63.515,19.093,56.96,19.498,33.889],[19.498,33.889,19.093,56.96,13.515,56.96,13.178,33.889,19.498,33.889],[13.178,33.889,13.515,56.96,12.639,63.515,7.735,63.515,13.178,33.889]],body:void 0,svg_line:"M-3.713,14.81L-8.61,14.81L-3.16,-14.81L3.159,-14.81L8.61,14.81L3.712,14.81L2.764,8.255L-2.844,8.255L-3.713,14.81ZM-2.054,3.831L2.053,3.831L0.079,-8.886L0,-8.886L-2.054,3.831Z"},{name:"P",width:16.4,height:29.7,x:27.8,y:33.9,cx:36,cy:48.7,vecs:[[27.806,33.889,32.861,51.416,32.861,63.583,27.806,63.498,27.806,33.889],[27.806,33.889,35.069,33.889,39.13,34.378,41.995,35.912,43.697,38.625,44.253,42.653,43.697,46.68,41.995,49.393,39.13,50.927,35.069,51.416,32.861,51.416,27.806,33.889]],body:void 0,svg_line:"M-8.215,14.771L-8.215,-14.85L-0.948,-14.85C5.292,-14.85 8.215,-12.401 8.215,-6.082C8.215,0.237 5.292,2.686 -0.948,2.686L-3.16,2.686L-3.16,14.85L-8.215,14.771ZM-3.16,-1.58L-1.185,-1.58C2.133,-1.58 3.16,-2.606 3.16,-6.161C3.16,-9.715 2.133,-10.742 -1.185,-10.742L-3.16,-10.742L-3.16,-1.58Z"},{name:"R",width:16.5,height:29.6,x:47,y:33.9,cx:55.3,cy:48.7,vecs:[[59.168,50.067,63.515,63.498,58.375,63.498,54.735,51.247,59.168,50.067],[47,33.889,54.112,33.889,56.134,34.007,57.887,34.361,59.37,34.968,60.583,35.861,61.527,37.041,62.201,38.541,62.605,40.377,62.74,42.568,62.656,44.22,62.42,45.635,62.066,46.815,61.611,47.792,61.072,48.584,60.465,49.225,59.825,49.714,59.168,50.067,54.735,51.247,52.123,51.399,47,33.889],[47,33.889,52.123,51.399,52.056,63.515,47,63.515,47,33.889]],body:void 0,svg_line:"M-3.198,14.81L-8.255,14.81L-8.255,-14.81L-1.145,-14.81C4.622,-14.81 7.465,-12.441 7.465,-6.121C7.465,-1.383 5.648,0.593 3.91,1.383L8.255,14.81L3.12,14.81L-0.514,2.568C-1.145,2.647 -2.25,2.725 -3.119,2.725L-3.198,14.81ZM-3.198,-1.541L-1.383,-1.541C1.383,-1.541 2.41,-2.566 2.41,-6.121C2.41,-9.676 1.383,-10.703 -1.383,-10.703L-3.198,-10.703L-3.198,-1.541Z"},{name:"I",width:5.1,height:29.6,x:66.5,y:33.9,cx:69,cy:48.7,vecs:[[71.571,34.11,66.515,33.889,66.515,63.515,71.571,63.515,71.571,34.11]],body:void 0,svg_line:"M-2.527,14.815L-2.527,-14.806L2.528,-14.814L2.528,14.815L-2.527,14.815Z"},{name:"A2",width:17.2,height:29.6,x:75.6,y:33.9,cx:84.2,cy:48.7,vecs:[[87.36,33.889,92.803,63.515,87.899,63.515,86.955,56.96,87.36,33.889],[87.36,33.889,86.955,56.96,81.377,56.96,81.04,33.889,87.36,33.889],[81.04,33.889,81.377,56.96,80.501,63.515,75.597,63.515,81.04,33.889]],body:void 0,svg_line:"M-3.713,14.81L-8.609,14.81L-3.159,-14.81L3.159,-14.81L8.609,14.81L3.713,14.81L2.844,8.255L-2.764,8.255L-3.713,14.81ZM-2.053,3.831L2.053,3.831L0.079,-8.886L-0.001,-8.886L-2.053,3.831Z"}],o=0;o<r.length;o++){for(var n=r[o],a=0;a<n.vecs.length;a++){for(var c=n.vecs[a],l=[],s=0;s<c.length;s+=2){var d=(c[s]-n.cx)/100,y=(c[s+1]-n.cy)/100;l.push(new e(d,y))}n.vecs[a]=l}n.width/=100,n.height/=100,n.x/=100,n.y/=100,n.cx/=100,n.cy/=100,n.x*=2,n.x-=1,n.y*=2,n.y-=1,n.cx*=2,n.cx-=1,n.cy*=2,n.cy-=1}var L=i.createBody(),v=i.createDynamicBody({allowSleep:!1,position:e(0,0)}),g=15,h=TWO_PI/92;for(o=0;o<92;o++){var f=o*h,x=e(Math.cos(f)*g,Math.sin(f)*g);friction=fixture_def_circle.friction,restitution=fixture_def_circle.restitution,density=fixture_def_circle.density,0==o&&(friction=1),v.createFixture(t.Box(.5,.5,x,f),{friction:friction,restitution:restitution,density:density})}function p(e,r,o){var n=i.createBody({position:o,type:"dynamic",allowSleep:!1});n.name=e;for(var a=0;a<r.length;a++){var c=r[a];n.createFixture(t.Polygon(c),fixture_def_char)}return n}i.createJoint(t.RevoluteJoint({motorSpeed:motor_speed,maxMotorTorque:1e8,enableMotor:!0},L,v,e(0,0)));for(o=0;o<r.length;o++){for(n=r[o],a=0;a<n.vecs.length;a++)for(s=0;s<n.vecs[a].length;s++)n.vecs[a][s].x*=30,n.vecs[a][s].y*=30;n.body=p(n.name,n.vecs,new e(n.cx*g,n.cy*g))}window.setInterval((function(){i.step(1/60)}),1e3/240),window.requestAnimationFrame((function t(){!function(){d3.selectAll(".apria_logo > *").remove(),d3.selectAll(".apria_logo").attr("width","100%").attr("height","100%").attr("viewBox","0 0 100 100"),d3.selectAll(".apria_logo").append("circle").attr("cx","50%").attr("cy","50%").attr("style","fill:transparent;").attr("r",50);for(var t=["rgb(255,0,0)","rgb(0,255,0)","rgb(0,0,255)","rgb(255,255,0)","rgb(0,255,255)"],e=0;e<r.length;e++){var i=r[e],o=(t[e],map(i.body.getPosition().x,-g,g,0,100)),n=map(i.body.getPosition().y,-g,g,0,100),a=i.body.getAngle()*R2D;d3.selectAll(".apria_logo").append("g").append("path").attr("d",i.svg_line).attr("id",i.name).attr("style","fill:white;").attr("transform","translate("+o+", "+n+") rotate("+a+", 0, 0)")}}(),window.requestAnimationFrame(t)}))}();