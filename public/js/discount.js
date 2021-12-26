$('#regular_price').on('wheel keyup change', function(event) {
	var regular_price = $("#regular_price").val();
	var discount = $("#discount").val();

	var sell_price = regular_price - (regular_price*(discount/100));

 	$("#sell_price").val(sell_price);
});

$('#discount').on('wheel keyup change', function(event) {
	var regular_price = $("#regular_price").val();
	var discount = $("#discount").val();

	var sell_price = regular_price - (regular_price*(discount/100));

 	$("#sell_price").val(sell_price);
});

$('#sell_price').on('wheel keyup change', function(event) {
	var regular_price = $("#regular_price").val();
	var sell_price = $("#sell_price").val();

	var diff = regular_price - sell_price;
	var discount = (diff/regular_price)*100;
	if (regular_price=='') {
		discount = 0;
	}

 	$("#discount").val(discount);
});
