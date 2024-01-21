// クリックしたら変数宣言された後、項目選択で切り替わる度に自動表示させる
$(function(){
    $('#B_Type').on('change', function(){
        var val = $(this).val();
        switch (val) {
            case "1":
                $('#B_Life').val("");
                break;
            case "2":
                $('#B_Life').val("47");
                break;
            case "3":
                $('#B_Life').val("47");
                break;
            case "4":
                $('#B_Life').val("34");
                break;
            case "5":
                $('#B_Life').val("19");
                break;
            case "6":
                $('#B_Life').val("22");
                break;
            default:
                $('#B_Life').val("");
                break;
        }
    });
});

//積算シミュレーター
$(function(){
    // blur で入力値制御
    $('#SekisanForm').on('blur', 'input', function(){ checkNum(this); });

    // 建物構造が変わったら
    $('#B_Type').on('change', function(){ sekisanSetLife(); sekisanSetCost(); });

    // 築年数が変わったら
    $('#B_Age').on('change', function(){ sekisanSetCost(); });

    // 計算ボタンが押されたら
    $('#CalcBtn').on('click', function(){
        sekisanCalculat();
    });
});

//入力制御
function checkNum(obj){
	let v = $(obj).val();
	if(v == ''){ return; }
	v = v.replace(/[０-９．]/g, function(s) { return String.fromCharCode(s.charCodeAt(0) - 65248); });
	let _a = v.split('.');
	v = _a[0].replace(/[^0-9]/g, '');
	let d = Number($(obj).data('few'));
	if(d == NaN || d < 0){
		$(obj).attr('data-few', 0);
	}else if( d > 0 && _a.length > 1){
		let f = _a[1].replace(/[^0-9]/g, '').substr(0, d);
		if(Number(f) > 0){ v += '.'+f; }
	}
	$(obj).val(v);
	return;
}
	
function sekisanSetCost(){
	checkNum($('#B_Age'));
	let a = Number($('#B_Age').val());
	let t = $('#B_Type').val();
	let v = '-';
	if(typeof a == NaN){ age = 0; }
	if(a in SekisanCosts[t]){ v = SekisanCosts[t][a]; } else { v = SekisanCostLasts[t]; }
	$('#B_Cost').val(v);
}

function sekisanSetLife(){
	let t = $('#B_Type').val();
	let v = SekisanLifes[t];
	$('#B_Life').html(v);
}

function sekisanCalculat(){
	sekisanSetCost();
	sekisanSetLife();
	//建物
	let bv = 0;
	checkNum($('#B_Size'));
	//延床面積×標準建築費÷耐用年数×(耐用年数－築年数)
	let s = Number($('#B_Size').val()), a = Number($('#B_Age').val());
	let s_f = Number($('#B_Size').data('few')), a_f = Number($('#B_Age').data('few'));
	let c = Number($('#B_Cost').html().trim()), l = Number($('#B_Life').html().trim());
	
	let s_d = Math.pow(10, s_f);
	let a_d = Math.pow(10, a_f);
	bv = Math.floor((s * s_d) * (c * 1000) / l * Math.max(l-a, 0) / (s_d * a_d));
	
	//土地
	let lv = 0;
	checkNum($('#L_Size'));
	checkNum($('#L_RTR'));
	s = Number($('#L_Size').val());
	c = Number($('#L_RTR').val());
	s_f = Number($('#L_Size').data('few'));
	s_d = Math.pow(10, s_f);
	//敷地面積×路線価
	lv = Math.floor((s * s_d) * (c * 1000) / s_d);
	
	//合計
	let tv = bv + lv;
	
	console.log('bv');
	$('#B_Result').html(formatPriceNum(bv));
	console.log('lv');
	$('#L_Result').html(formatPriceNum(lv));
	console.log('tv');
	$('#All_Result').html(formatPriceNum(tv));
	
	// if($('#ResultMove').length == 1){
	// 	$('html,body').animate({scrollTop:$('#ResultMove').offset().top -100}, 500, 'swing');
	// }
}
function formatPriceNum(v, _d){
	console.log(v);
	//万だけ付けたい
	let a = (v / 10000).toFixed(4).toString().split('.');
	v = format3(a[0])+'万';
	a[1] = Number(a[1]);
	console.log(a);
	if(a[1] > 0 && _d != 1){
		v += format3(a[1]);
	}
	console.log(v);
	return v;
}
function format3(num){
	num = num.toString();
	while(num != (num = num.replace(/^(-?\d+)(\d{3})/g, "$1,$2")));
	return num;
}