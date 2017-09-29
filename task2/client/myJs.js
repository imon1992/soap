function getXmlHttp(){
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

var filterBtn = document.querySelector('#filterBtn');
filterBtn.addEventListener("click", function(){
    console.log(123);
var c = document.querySelector('#model');
console.log(c[c.selectedIndex].innerHTML);
var sortObj = {};
if(c[c.selectedIndex].innerHTML != 'none'){
    sortObj[c[c.selectedIndex].innerHTML] = c[c.selectedIndex].innerHTML;
    console.log(sortObj);
}
});
getAllModelMarkId();
//var allModelMarkId;
function getAllModelMarkId(){
    var json_upload = "AllModelsMarksId=" + JSON.stringify('AllModelsMarksId');
    console.log(json_upload);
    var xmlhttp = getXmlHttp()
    xmlhttp.open('POST', 'http://192.168.0.15/~user14/soap/task2//client/soapClient.php', false);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(json_upload);
    if(xmlhttp.status == 200) {
        allModelMarkId = JSON.parse(xmlhttp.responseText);
        console.log(allModelMarkId);
        showCars(allModelMarkId);
    }
}
//showCars();
function showCars(cars){
    var contentBlock = document.querySelector('.contentBlock');
    console.log(contentBlock);
    for(car in cars){
        var a = document.createElement('a')
       var div = document.createElement('div');
       var pMark = document.createElement('p');
       var pModel = document.createElement('p');
       div.setAttribute('class','col-md-4');
      a.setAttribute('href','http://192.168.0.15/~user14/soap/task2/client/templates/car?id=' + cars[car].id); 
       pMark.innerHTML =cars[car].mark;
      pModel.innerHTML = cars[car].model; 
      a.appendChild(pMark); 
a.appendChild(pModel);
div.appendChild(a);
contentBlock.appendChild(div);
        console.log(cars[car].id);
console.log(cars[car].mark);

    }
}


//var json_upload = "json_name=" + JSON.stringify({'carId':1,'firstName':'Andrew','surname':'Kolotii','paymentMethod':'credit card'});
//console.log(json_upload);
//var xmlhttp = getXmlHttp()
//xmlhttp.open('POST', 'http://soap/task2/client/soapClient.php', false);
//xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//xmlhttp.send(json_upload);
//if(xmlhttp.status == 200) {
//    alert(xmlhttp.responseText);
//}

