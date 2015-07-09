//On load:

window.onload = function(){

    // heatmap configuration
    var config = {
        container: document.querySelector(".heatmapArea"),
        radius: 20,
        maxOpacity: .7,
    };
    
    //creates and initializes the heatmap
    var heatmap = h337.create(config);
 
    var patcount = 0;

    //adds a point to the canvas and datastore on touch or click, and adds 1 to the counter
    document.querySelector(".heatmapArea").ontouchstart = function(ev){
        heatmap.addData({
            x: ev.layerX, 
            y: ev.layerY,
            value: 1
            });
        ev.preventDefault();
        patcount += 1;
        document.getElementById("patcounter").innerHTML = patcount;
    };

    document.querySelector(".heatmapArea").onclick = function(ev){
        heatmap.addData({
            x: ev.layerX,
            y: ev.layerY,
            value: 1
            });
        patcount += 1;
        document.getElementById("patcounter").innerHTML = patcount;
    };

    //initial setting for the heatmap canvas
	heatmap.setData({max: 3, min: 0, data: []});
 
    //initialize the variables with an array of the coordinates for each floor
    var dataTotal1 = heatmap.getData();
    var dataTotal2 = heatmap.getData();
    var dataTotal3 = heatmap.getData();
    var dataTotal4 = heatmap.getData();
    var dataTotal5 = heatmap.getData();    

    //declare the variable for the floor number of the map currently visible on screen
 	var currentFloorNum;

    //determines the floor number of the currently active map - 
    //function is to be used just before switching, to determine which floor variable to store data to.
	function findFloorNum(){
		switch (currentFloor){
            case floormap.map1fl:
                currentFloorNum = 1;
                break;

            case floormap.map2fl:
                currentFloorNum = 2;
                break;

            case floormap.map3fl:
                currentFloorNum = 3;
                break;

            case floormap.map4fl:
                currentFloorNum = 4;
                break;

            case floormap.map5fl:
                currentFloorNum = 5;
                break;
		};
	}

    //stores coordinates from the current map to the variable associated with that floor - 
    //to be used when switching floors in conjunction with findFloorNum().
	function storeData(x){
        switch(x){

           case 1:
                dataTotal1 = heatmap.getData();
                break;

    	   case 2:
                dataTotal2 = heatmap.getData();
                break;

    	   case 3:
                dataTotal3 = heatmap.getData();
                break;

    	   case 4:
                dataTotal4 = heatmap.getData();
                break;

    	   case 5:    
                dataTotal5 = heatmap.getData();
                break;    			
    	};
	}


    //upon switching floors, stores the current floors coordinates to the appropriate variable, changes the map being displayed, 
    //and returns that floor's data on the heatmap canvas.
	$("#button1fl").click(function(){
		findFloorNum();
		storeData(currentFloorNum);
    	currentFloor = floormap.map1fl;
    	imageObj.src = currentFloor;
    	context.drawImage(imageObj, 0, 0);
    	heatmap.setData(dataTotal1); 
    });

    $("#button2fl").click(function(){
		findFloorNum();
        storeData(currentFloorNum);
    	currentFloor = floormap.map2fl;
    	imageObj.src = currentFloor;
    	context.drawImage(imageObj, 0, 0);
    	heatmap.setData(dataTotal2);
    });

    $("#button3fl").click(function(){
        findFloorNum();
        storeData(currentFloorNum);
    	currentFloor = floormap.map3fl;
    	imageObj.src = currentFloor;
    	context.drawImage(imageObj, 0, 0);
    	heatmap.setData(dataTotal3);
    });

    $("#button4fl").click(function(){
		findFloorNum();
        storeData(currentFloorNum);
    	currentFloor = floormap.map4fl;
    	imageObj.src = currentFloor;
    	context.drawImage(imageObj, 0, 0);
    	heatmap.setData(dataTotal4);
    });

    $("#button5fl").click(function(){
		findFloorNum();
        storeData(currentFloorNum);
    	currentFloor = floormap.map5fl;
    	imageObj.src = currentFloor;
    	context.drawImage(imageObj, 0, 0);
    	heatmap.setData(dataTotal5);
    });

    //on submit, stores the current floor's data, converts the arrays of coordinates for each floor into strings, 
    //stores that data into the corresponding HTML hidden input fields, and determines the total number of patrons from the walkthrough.
    $("#allButton").click(function(){
        findFloorNum();
        storeData(currentFloorNum);
        var jsonStrTotal1 = JSON.stringify(dataTotal1);
        var jsonStrTotal2 = JSON.stringify(dataTotal2);
        var jsonStrTotal3 = JSON.stringify(dataTotal3);
        var jsonStrTotal4 = JSON.stringify(dataTotal4);
        var jsonStrTotal5 = JSON.stringify(dataTotal5);
        var numOfPatrons = dataTotal1.data.length + dataTotal2.data.length + dataTotal3.data.length + dataTotal4.data.length + dataTotal5.data.length;
        $("#dot1fl").val(jsonStrTotal1);
        $("#dot2fl").val(jsonStrTotal2);
        $("#dot3fl").val(jsonStrTotal3);
        $("#dot4fl").val(jsonStrTotal4);
        $("#dot5fl").val(jsonStrTotal5);
        $("#pcount").val(numOfPatrons);
    });

    //this object defines all of the different map images
    floormap = {
        map1fl: 'http://timdannay.com/building/heatmap_v2/v2_1fl.jpg',
        map2fl: 'http://timdannay.com/building/heatmap_v2/v2_2fl.jpg',
        map3fl: 'http://timdannay.com/building/heatmap_v2/v2_3fl.jpg',
        map4fl: 'http://timdannay.com/building/heatmap_v2/v2_4fl.jpg',
        map5fl: 'http://timdannay.com/building/heatmap_v2/v2_5fl.jpg',
    };

    //initializes the canvas with the 3rd floor map
    var currentFloor = floormap.map3fl;

    //canvas and background image creation
    var canvas = document.querySelector(".libmap1");
    var context = canvas.getContext("2d");
    var imageObj = new Image();

    //draws the HTML5 canvas
    imageObj.onload = function() {
    context.drawImage(imageObj, 0, 0);
    };

    //displays whichever image from the floormap object is stores in the currentFloor variable (3rd floor to start)
    imageObj.src = currentFloor;

}
