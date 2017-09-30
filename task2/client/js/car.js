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

function $_GET(key) {
    var s = window.location.search;
    s = s.match(new RegExp(key + '=([^&=]+)'));
    return s ? s[1] : false;
}
getCarInfo();

function getCarInfo(){
    var carId = $_GET('id');

    var carId = "carId=" + JSON.stringify(carId);
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', 'http://192.168.0.15/~user14/soap/task2//client/soapClient.php', false);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(carId);

    if(xmlhttp.status == 200) {
        var carInfo = JSON.parse(xmlhttp.responseText);
        showCarInfo(carInfo);
    }
}

function showCarInfo(carInfo){
    if(typeof carInfo != 'object'){
        alert('some error');
        return;
    }
    var CarInfoBlock = document.querySelector('#car');
    var carDiv = document.createElement('div');
    var orderDiv = document.createElement('div');
    var pModel = document.createElement('p');
    var pMark = document.createElement('p');
    var pYear = document.createElement('p');
    var pEngine = document.createElement('p');
    var pColor = document.createElement('p');
    var pPrice = document.createElement('p');
    var orderBtn = document.createElement('button');

    carDiv.setAttribute('id','carInfo');
    orderDiv.setAttribute('id','order');
    pModel.innerHTML = "Model:" + carInfo[0].model;
    pMark.innerHTML = "Mark:" + carInfo[0].mark;
    pYear.innerHTML = "Year of issue" + carInfo[0].year;
    pEngine.innerHTML = 'Engine:' + carInfo[0].engine;
    pColor.innerHTML = "Color:" + carInfo[0].color;
    pPrice.innerHTML = "Price:" + carInfo[0].price;
    orderBtn.innerHTML = 'Order car';
    orderBtn.setAttribute('class','btn');

    orderBtn.addEventListener('click',function(){
        var firstName = document.createElement('input');
        var surname = document.createElement('input');
        var paymentMethod = document.createElement('select');
        var option1 = document.createElement('option');
        var option2 = document.createElement('option');
        var sendOrder = document.createElement('button');


        option1.innerHTML = 'credit card';
        option2.innerHTML = 'cash';
        sendOrder.innerHTML = 'order this car';

        paymentMethod.appendChild(option1);
        paymentMethod.appendChild(option2);

        firstName.setAttribute('placeholder','First Name');
        surname.setAttribute('placeholder','Last Name');
        sendOrder.setAttribute('class','btn');
        orderDiv.appendChild(firstName);
        orderDiv.appendChild(surname);
        orderDiv.appendChild(paymentMethod);
        orderDiv.appendChild(sendOrder);

        sendOrder.addEventListener('click',function(){
            function insertAfter(newNode, referenceNode) {
                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
            }

            var orderObj = {};
                var pErrorFName = document.createElement('p');
                var pErrorLName = document.createElement('p');
            pErrorFName.innerHTML = 'field this fild';
            pErrorLName.innerHTML = 'field this fild';
            if(firstName.value != ''){
                orderObj.firstName = firstName.value;

            }else
            {
                insertAfter(pErrorFName,firstName);
                return;
            }
            if(surname.value != ''){
                orderObj.surname = surname.value;
            }else
            {
                insertAfter(pErrorLName,surname);
                return;
            }
            orderObj.paymentMethod = paymentMethod[paymentMethod.selectedIndex].innerHTML;

            var carId = $_GET('id');

            orderObj.carId = carId;

            var order = "order=" + JSON.stringify(orderObj);
            var xmlhttp = getXmlHttp();
            xmlhttp.open('POST', 'http://192.168.0.15/~user14/soap/task2//client/soapClient.php', false);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(order);

            if(xmlhttp.status == 200) {
                var orderResult = JSON.parse(xmlhttp.responseText);
                alert(orderResult);
            }
        })
    })

    carDiv.appendChild(pModel);
    carDiv.appendChild(pMark);
    carDiv.appendChild(pYear);
    carDiv.appendChild(pEngine);
    carDiv.appendChild(pColor);
    carDiv.appendChild(pPrice);
    carDiv.appendChild(orderBtn);

    CarInfoBlock.appendChild(carDiv);
    CarInfoBlock.appendChild(orderDiv);


}