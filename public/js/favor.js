$(document).ready(() => {

	alert("Для использования этой функции вы должны быть авторизованы!");
	// Обработчик нажатия кнопки like
	$("#isFav-form").submit(function(e) {
		event.stopPropagation();
    	event.stopImmediatePropagation();

    var form = document.querySelector('#isFav-form');
    var data = new FormData(form);

		$.ajax({
			url : "/favorites/post",
      type:'POST',
      data:data,

      success:function(data){
          alert(data.success);
       }

			error: function(xhr) {
				console.log(xhr['responseText']);
			}
		});
	});

	$('.fav-button').on('click', '.fav-button', function () {
		var link = $(this);
		var value = link.attr('value');

		$.ajax({
			url : "/favorites/post",
			data : {'value' : value},

			success : function(data) {
					// Если пользователь не авторизован
					alert("Для использования этой функции вы должны быть авторизованы!");
				}
			},

			error: function(xhr) {
				console.log(xhr['responseText']);
			}
		});
	});


});
