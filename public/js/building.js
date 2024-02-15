$('#building_age, #building_structure').on('change', function() {
    // 現在の年(西暦)を取得
    let current_year = new Date().getFullYear();
    // ビューのcalc1のvalueにある築年数を取得する
    let building_age = $('#building_age').val();
    // データベースの値（西暦）を取得のため{（現在の西暦ー築年数＝建築築年（西暦））}
    let built_year = current_year - building_age;
    //  ビューのcalc1にあるbuilding_structureのvalueを条件に算出する
    let building_structure = $('#building_structure').val();

    $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });
    $.ajax({
        type: "POST",
        url: "../data_building",
        async: true,
        dataType: 'json',
        data: {
            built_year: built_year,
            building_structure: building_structure,
            building_age: building_age
        }
    })
    .done((data) => {
      console.log(data);
        // calc1のビューでid=construction_costの箇所に入れる
      $('#construction_cost').val(parseFloat(data.construction_cost.price));
     $("#calculation1, #calculation2").on("click", function() {
    $('#lbl_construction_cost').html(`${parseFloat(data.construction_cost.price)} 万円`);
});
    })
    .fail((error) => {
        // alert('建築構造を選択してください');
    });

});
