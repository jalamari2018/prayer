function _getId(id){
	return document.getElementById(id);
}
function calculatePrice() {
	var total_price = _getId('total_price').value;
	var paid = _getId('paid').value;
	_getId('debt').value = total_price - paid;


}

var datalist = {};
var xhr = new XMLHttpRequest();

var month = new Date().getMonth()+1;
	year  = new Date().getFullYear();

xhr.open("GET","http://api.aladhan.com/v1/calendarByCity?city=Colorado Springs&country=United States&method=2&month="+month+"&year="+year,true);
if (xhr.readyState !== 4) {
	// document.getElementById("customer_list").innerHTML = "please wait....";
}
xhr.onreadystatechange = function () {

	if (xhr.readyState == 4 && xhr.status== 200) {

		datalist = JSON.parse(xhr.responseText);
			//console.log(datalist);
			var today = new Date().getDate() -1 ;
			//getting prayers times
			var prayers_today = datalist.data[today].timings;
			//get the date in Hijri
			var monthHijri = datalist.data[today].date.hijri.month.ar;
			var dayHijri = datalist.data[today].date.hijri.weekday.ar;
			var daydateHijri = parseInt(datalist.data[today].date.hijri.day)+(1);
			var yearHijri = datalist.data[today].date.hijri.year;
			var dateInHijri = dayHijri +"-" + daydateHijri +""+monthHijri +"-"+yearHijri;
			//console.log(dateInHijri);
			_getId("thedate").innerHTML = dateInHijri;
			translator(prayers_today);
			//updateui(prayers_today);
			
		

			// "<div class='right floated content'><div class='ui button'>"+ prayers_today[p] +"</div></div>"
	//console.log(prayers_today);
	}
}

xhr.send();

function updateui(prayers_today){
	for(var p in prayers_today){
		document.getElementById("prayer_list").innerHTML += "<div class='item orange' dir='rtl'><div class='left floated content'><div class='ui button '>"+ prayers_today[p] +"</div></div><div class='ui header'>"+ p +"</div></div>";
	}
}
function translator(prayers_today){
	var ptarabic = {
		الفجر : prayers_today.Fajr.substring(0, 5),
		الظهر : prayers_today.Dhuhr.substring(0, 5),
		العصر : prayers_today.Asr.substring(0, 5),
		المغرب : prayers_today.Maghrib.substring(0, 5),
		العشاء : prayers_today.Isha.substring(0, 5)
	
	}
	//console.log(ptarabic);
	updateui(ptarabic);

}


