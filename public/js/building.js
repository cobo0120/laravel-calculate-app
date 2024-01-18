let changeTimer = null;

$('#building_age').on('input', function() {
 if (changeTimer !== null) clearTimeout(changeTimer);
 changeTimer = setTimeout(function() {
  // 現在の年数を取得
   let current_year = new Date().getFullYear();
  // ビューcalc1にある築年数を取得する
   let age_of_building = $('#building_age').val();
  // データベースの値（西暦）を取得のため{（現在の西暦ー）}
   let built_year = current_year - age_of_building;
  //  ビューcalc1にあるbuilding_structureのvalueを条件に算出する
   let building_structure = $('#building_structure').val();
  //  建物の年数（西暦）と建築構造を条件にデータベースから値を取得する
   let url = "../data_building/" + built_year + "/" + building_structure;
   
   $.ajax({
       type: "GET",
       url: url,
       async: true,
       dataType: 'json',
   })
   .done((data) => {
      if (typeof data !== 'undefined' && data !== null) {
          $('#construction_cost').val(data.constructionCost);
      } 
      else {
          // 建築年（西暦）が現在の西暦よりも大きい場合
          if (built_year > current_year) {
              // 最新の建築構造の値を取得
              url = "../data_building/" + current_year + "/" + building_structure;
              // 建築年（西暦）が現在の西暦よりも小さい場合
          } else {
              // 最古の建築構造の値を取得
              url = "../data_building/" + 0 + "/" + building_structure;
          }

          $.ajax({
              type: "GET",
              url: url,
              async: true,
              dataType: 'json',
          })
          .done((data) => {
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

//   // 標準建築価格を築年数ごとに変更させて#buiding_ageのinput欄に表示させる
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