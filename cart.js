var fav=document.getElementsByName("fav[]");

function checkTest1(th){

  var flag=th.checked;
  
	for (var i in fav) {
		fav[i].checked=flag;
	}
}

function checkTest2(){
	var flag=true;
	for (var i=1;i<fav.length-1;i++) {
		if (!fav[i].checked) {
			flag=false;
			break;
		}
  }
  
fav[0].checked=flag;
fav[fav.length-1].checked=flag;
  
	var total=0;
	var num=0;
	var spNum=0;
	
	for (var i=1;i<fav.length-1;i++) {
		if (fav[i].checked) {
			num++;
			var par =fav[i].parentNode.parentNode;
			var li= par.getElementsByTagName("li");
			var t=li[6].innerText.split("$")[1];
			total+=Number(t);
			document.getElementById("total").innerText=total;
			
			var t2=li[5].getElementsByTagName("input");
			var num2=t2[0].value;
			spNum+=Number(num2);
			document.getElementById("snum").innerText=spNum;
		}
  }
	if(num==0){
	 	document.getElementById("total").innerText=0;	
	 	document.getElementById("snum").innerText=0;
	}
}

function checkTest3(th,sig){
	var pre;
	if (sig=="1") {
		pre=th.nextElementSibling;
		if (Number(pre.value)>0) {
			pre.value=Number(pre.value)-1;
		  }
		}else{
			pre=th.previousElementSibling;
			pre.value=Number(pre.value)+1;
		}
		
		var val=pre.parentNode.previousElementSibling.innerText;
		var total=Number(val)*Number(pre.value)
		pre.parentNode.nextElementSibling.innerText ="$"+total;
}

function checkTest4(th){
	var div=th.parentNode.parentNode.parentNode;
	div.remove();
}

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

		display.textContent = minutes + ":" + seconds;
		
        if (--timer < 0) {
			document.getElementById("notification").innerHTML = "Time is up! Now your cart is empty<br>Please re-add items to your shopping cart!";
			for (var i =1; i < (fav.length + 1); i++){
			var div = document.getElementById("info warp");
			div.remove();
			checkTest2();
			window.location = "cart.php?clear=true";
		}
		}
    }, 1000);
}

window.onload = function () {   
	var time = 60 * 10;
    display = document.querySelector('#time');
    startTimer(time, display);
}

function placeorder(){
	if (document.getElementById("snum").innerText == 0) {
		window.alert("Please select at least one item");
	} else {
		window.alert("We have received your order! \n Order processing...");
	}
}