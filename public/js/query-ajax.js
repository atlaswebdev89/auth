function startLoadingAnimation() // - функция запуска анимации
{
	$("#information").empty();
	var imgObj = $("#loadImg");
  	imgObj.show(); 
}
 
function stopLoadingAnimation() // - функция останавливающая анимацию
{
  $("#loadImg").hide();
}

function funcBefore () {
	$("#information").html("Ожидание данных ...");
}

function funcSuccess (data) {
	stopLoadingAnimation();
	$("#information").html(data);
	$("#load").prop('disabled', false);
}

$(document).ready (function () {
	$("#load").bind("click", function () {
		var form = $(this);
		form.attr('disabled', 'disabled');
		var tech = $("select[name='technology']").val();
		var stats = $("select[name='stats']").val();
		var date_first = $("input[name='date_first']").val();
		var date_last = $("input[name='date_last']").val();		
		$.ajax ({
			url:"/query",
			type: "POST",
			data: ({technology: tech, target: stats, date_first: date_first, date_last: date_last}),
			dataType: "html",
		//	beforeSend:funcBefore,
			beforeSend:startLoadingAnimation,
			success: funcSuccess,
			
			error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
		            alert(xhr.status); // пoкaжeм oтвeт сeрвeрa
		            alert("ERROR"); // и тeкст oшибки
		         },
	
			complete: function(data) { // сoбытиe пoслe любoгo исхoдa
 				form.prop('disabled', false); // в любoм случae включим кнoпку oбрaтнo

		         }


		});
		
	});
});
