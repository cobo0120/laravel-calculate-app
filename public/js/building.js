let changeTimer = null;

$('#building_age').on('input', function() {
 if (changeTimer !== null) clearTimeout(changeTimer);
 changeTimer = setTimeout(function() {
  // 現在の年数を取得
   let current_year = new Date().getFullYear();
  // ビューのcalc1にある築年数を取得する
   let age_of_building = $('#building_age').val();
  // データベースの値（西暦）を取得のため{（現在の西暦ー築年数＝建築築年（西暦））}
   let built_year = current_year - age_of_building;
  //  ビューのcalc1にあるbuilding_structureのvalueを条件に算出する
   let building_structure = $('#building_structure').val();
  //  建物の年数（西暦）と建築構造を条件にデータベースから値を取得する
   
   $.ajax({
       type: "POST",
       url: "../data_building",
       async: true,
       dataType: 'json',
       data: { 
        building_structure: building_structure, 
        built_year: built_year 
        },//ここはサーバーに贈りたい情報。
   })
   .done((data) => {
    // もしデータベース内にデータがない場合（例えば、築年数１〜3年はデータベースにないor築年数が古くてない）
      if (typeof data !== 'undefined' && data !== null) {
          $('#construction_cost').val(data.constructionCost);
      } 
      else {
          // もし建築年（西暦）が3年よりも小さい場合
          if (building_age >= 3 ) {
              // データベースから該当の建築構造の古い数値を取得し
              $('#construction_cost').val(data.constructionCost);
              // それ以外ならば
          } else {
              // データベースから該当の建築構造の最新数値を取得
             $('#construction_cost').val(data.constructionCost);
          }

          $.ajax({
              type: "POST",
              url: "../data_building",
              async: true,
              dataType: 'json',
              data: { 
                building_structure: building_structure, 
                built_year: built_year 
                },//ここはサーバーに贈りたい情報。
          })
          .done((data) => {
            // calc1のビューでid=construction_costの箇所に入れる
              $('#construction_cost').val(data.constructionCost);
          })
          .fail((error) => {
              alert('通信失敗');
          });
      }
  })
   .fail((error) => {
       alert('通信失敗');
   });
   changeTimer = null;
 }, 300);
});


// let changeTimer = null;

// $('#building_age').on('input', function() {
//  if (changeTimer !== null) clearTimeout(changeTimer);
//  changeTimer = setTimeout(function() {
//      let current_year = new Date().getFullYear();
//      let age_of_building = $('#building_age').val();
//      let built_year = current_year - age_of_building;
     
//      $.ajax({
//          type: "GET",
//          url: "../data_building",
//          async: true,
//          dataType: 'json',
//          data: { page: 1 },
//      })
//      .done((data) => {
//          $('#construction_cost').val(data.constructionCost);
//      })
//      .fail((error) => {
//          alert('通信失敗');
//      });
//      changeTimer = null;
//  }, 300);
// });




// // calc1からidのbuilding_ageの数値が変化したら非同期処理を開始する
// $('#building_age').on('change', () => {
//  $.ajax({
//    type: "GET",
//    url: "../data_building",
//    async: true,
//    dataType: 'json',
//    data: { page: 1 },
//  })
//  .done((data) => {

//   // 標準建築価格を築年数ごとに変更させて#building_ageのinput欄に表示させる
//    const constructionCost = $("#construction_cost");
//    constructionCost.val(data.constructionCost);
//  })
//  .fail((error) => {
//    alert('通信失敗');
//  });
// });
// $('.building').on('click', () => {
//  $.ajax({
//    type: "GET",
//    url: "../data_destination",
//    async: true,
//    dataType: 'json',
//    data: { page: 1 },
//  })
//  .done((data) => {
//    const constructionCost = $("#construction_cost");
//    constructionCost.val(data.constructionCost);
//  })
//  .fail((error) => {
//    alert('通信失敗');
//  });
// });

// $(document).on('click', () => {
//  $("#building_structure").on('change', () => {
//    let structure = $("#building_structure").val();
//    let age = $("#building_age").val();
//    updateData(structure, age);
//  });

//  $("#building_age").on('change', () => {
//    let structure = $("#building_structure").val();
//    let age = $("#building_age").val();
//    updateData(structure, age);
//  });
// });

// function updateData(structure, age) {