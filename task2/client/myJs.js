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
getAllModelMarkId();
var allModelMarkId;
function getAllModelMarkId(){
    var json_upload = "AllModelsMarksId=" + JSON.stringify('AllModelsMarksId');
    console.log(json_upload);
    var xmlhttp = getXmlHttp()
    xmlhttp.open('POST', 'http://soap/task2/client/soapClient.php', false);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(json_upload);
    if(xmlhttp.status == 200) {
        allModelMarkId = JSON.parse(xmlhttp.responseText);
        console.log(allModelMarkId);
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

