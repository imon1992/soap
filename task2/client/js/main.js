getAllModelMarkId();
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
    var year = document.querySelector('#year');
    var engine = document.querySelector('#engine');
    var color = document.querySelector('#color');
    var maxSpeed = document.querySelector('#maxSpeed');
    var price = document.querySelector('#price');

    var sortObj = {};

    if(model[model.selectedIndex].innerHTML != 'none'){
        sortObj.model = model[model.selectedIndex].innerHTML;
    }
    if(year[year.selectedIndex].innerHTML != 'none'){
        sortObj.year = year[year.selectedIndex].innerHTML;
        var error = document.querySelector('.error');
        error.innerHTML = '';
    }else{
        var error = document.querySelector('.error');
        error.innerHTML = 'This field is compulsory';
        error.style.color = 'red';
        return
    }
    if(engine[engine.selectedIndex].innerHTML != 'none'){
        sortObj.engine = engine[engine.selectedIndex].innerHTML;
    }
    if(color[color.selectedIndex].innerHTML != 'none'){
        sortObj.color = color[color.selectedIndex].innerHTML;
    }
    if(maxSpeed[maxSpeed.selectedIndex].innerHTML != 'none'){
        var maxSpeed = maxSpeed[maxSpeed.selectedIndex].innerHTML;
        var maxSpeedArr = maxSpeed.split('-');
        sortObj.maxSpeed = maxSpeedArr;
    }
    if(price[price.selectedIndex].innerHTML != 'none'){
        var price = price[price.selectedIndex].innerHTML;
        var priceArr = price.split('-');
        sortObj.price = priceArr;
    }

    var jsonObj = JSON.stringify(sortObj);
    if(jsonObj != "{}"){
        var getCars = "sortCar=" + jsonObj;
        var xmlhttp = getXmlHttp();
        xmlhttp.open('POST', 'http://192.168.0.15/~user14/soap/task2//client/soapClient.php', false);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(getCars);

        if(xmlhttp.status == 200) {
            var sortModelMarkId = JSON.parse(xmlhttp.responseText);
            showCars(sortModelMarkId);
        }
    }

});


function getAllModelMarkId(){
    var getCars = "AllModelsMarksId=" + JSON.stringify('AllModelsMarksId');
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', 'http://192.168.0.15/~user14/soap/task2//client/soapClient.php', false);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(getCars);

    if(xmlhttp.status == 200) {
        var allModelMarkId = JSON.parse(xmlhttp.responseText);
        showCars(allModelMarkId);
    }
}

function showCars(cars){
    if(typeof cars != 'object'){
        alert('some error');
        return;
    }
    var contentBlock = document.querySelector('.contentBlock');

    contentBlock.innerHTML ='';
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

    }
}


