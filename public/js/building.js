$('#building_age').on('input', function() {
    // 現在の年を取得
    let current_year = new Date().getFullYear();
    // ビューのcalc1のvalueにある築年数を取得する
    let building_age = $('#building_age').val();
    // データベースの値（西暦）を取得のため{（現在の西暦ー築年数＝建築築年（西暦））}
    let built_year = current_year - building_age;
    //  ビューのcalc1にあるbuilding_structureのvalueを条件に算出する
    let building_structure = $('#building_structure').val();

    $.ajax({
        type: "POST",
        url: "../data_building",
        async: true,
        dataType: 'json',
        data: {
            built_year: built_year,
            building_structure: building_structure,
        }
    })
    .done((data) => {
        // calc1のビューでid=construction_costの箇所に入れる
        $('#construction_cost').val(data.construction_cost);
    })
    .fail((error) => {
        alert('通信失敗');
    });
});
