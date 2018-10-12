var images = ["images/hanba-gu.jpg","images/butabara.jpg",
"images/hanba-gu.jpg","images/butabara.jpg","images/hanba-gu.jpg"]
var images2 = [];
changeImage(num);
var current = 0;
var changeImage = function(num){
	if(current + num >= 0 && current + num < images.length){
		current += num;
		document.getElementById("main_image").src = images[current];
		pageNum();
	}
	setTimeout(changeImage, 3000);
};

var preloadImage = function(path){
	var imgTag = document.createElement('img');
		imgTag.src = path;
}
for(var i = 0; i < images.length; i++){
	preloadImage(images[i]);
}