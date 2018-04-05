var state = {1:'Не оплачен',2:'Оплачен',3:'Отправлен'};

$(document).ready(function() {
   get_orders();
});

function add_() {
   var user = $("#user").val() || '';
   var price = $("#price").val() || '';
   var state_id = $("#state_id").val() || 0;
   if(user=='' || price=='' || state_id==0){
      alert('Error input data');
      return;
   }
   var url = 'include/ajax.php?action=add_';
   $.post(url,{user:user,price:price,state:state_id},
        function(json){
           if(json) {
              if(json.status=='success') {
                 //alert(json.text);
				 get_orders();
              }
			  if(json.status=='error') {
                 alert(json.text);
              }
           } else {
              alert('Bad request');
           }  
        },
        'json'
    );
}

function delete_(id) {
   if(id=='' || id==0){
      alert('Error input data');
      return;
   }
   var url = 'include/ajax.php?action=delete_';
   $.post(url,{id:id},
        function(json){
           if(json) {
              if(json.status=='success') {
                 //alert(json.text);
				 get_orders();
              }
			  if(json.status=='error') {
                 alert(json.text);
              }
           } else {
              alert('Bad request');
           }  
        },
        'json'
    );
}

function payment_(id) {
   if(id=='' || id==0){
      alert('Error input data');
      return;
   }
   var url = 'include/ajax.php?action=payment_';
   $.post(url,{id:id},
        function(json){
           if(json) {
              if(json.status=='success') {
                 //alert(json.text);
				 get_orders();
              }
			  if(json.status=='error') {
                 alert(json.text);
              }
           } else {
              alert('Bad request');
           }  
        },
        'json'
    );
}

function get_orders() {
   var url = 'include/ajax.php?action=get_orders';
   $.post(url,{},
        function(json){
           if(json) {
              if(json.status=='success') {
                 var html = '<table border="1">';
				 html += '<tr><th>Пользователь</th><th>Номер заказа</th><th>Сумма заказа</th><th>Дата оплаты</th><th>Дата создания</th><th>Статус заказа</th><th></th></tr>';
			     var orders = json.orders;
			     for(var key in orders){
				    html += '<tr>';
				    html += '<td>'+(orders[key].user || '')+'</td>';
					html += '<td>'+(orders[key].order_name || '')+'</td>';
					html += '<td>'+(orders[key].price || '')+'</td>';
					html += '<td>'+(orders[key].buy_date || '')+'</td>';
					html += '<td>'+(orders[key].create_date || '')+'</td>';
					html += '<td>'+(state[orders[key].state] || '')+'</td>';
					html += '<td><b style="cursor:pointer;" onclick="payment_('+(orders[key].id || 0)+')">проплать</b> / ';
					html += '<b style="cursor:pointer;" onclick="delete_('+(orders[key].id || 0)+')">удалить</b></td>';
				    html += '</tr>';
			     }
			     html += '</table>';
				 $("#orders").html(html);
              }
			  if(json.status=='error') {
                 alert(json.text);
              }
           } else {
              alert('Bad request');
           }  
        },
        'json'
    );
}

function show_form() {
   if($("#add_order").css("display")=='none') show_block("add_order",'visible','block');
     else close_block("add_order",'hidden','none');
}

function show_block(obj,param1,param2) {
   $("#"+obj).css("visibility",param1);
   $("#"+obj).css("display",param2);
}

function close_block(obj,param1,param2) {
   if(param1!='') $("#"+obj).css("visibility",param1);
   if(param2!='') $("#"+obj).css("display",param2);
}