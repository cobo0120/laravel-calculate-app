// 用語の意味
// site_area, siteArea = '敷地面積'
// rode_price, rodePrice = '路線価'
// building_area, buildingArea = '建物面積'
// building_structure, buildingStructure ='建物構造'
// construction_cost, constructionCost ='標準建築費'
// service_life, serviceLife = '耐用年数'
// building_age = '築年数'
// remaining_life = '残存年数'

// 再調達原価だが、使用するかクライアントに確認する
// 1/4再調達原価は使わない
//  const src = 180000;
//  const rc = 180000;
//  const s = 150000;
//  const keitetsu = 130000;
//  const mokuzou = 130000;




// クリックしたら変数宣言された後、項目選択で切り替わる度に自動表示させる
document.addEventListener('click', () => {
 const buildingStructure = document.querySelector('#building_structure');
 const constructionCost = document.querySelector("#construction_cost");
 const serviceLife = document.querySelector("#service_life");
 

 buildingStructure.addEventListener('change', () => {
   let val = buildingStructure.value;
   switch (val) {
       case "1":
           constructionCost.value = "";
           serviceLife.value = "";
           break;
       case "2":
           constructionCost.value = "262.2";
           serviceLife.value = "47";
           break;
       case "3":
           constructionCost.value = "240.2";
           serviceLife.value = "47";
           break;
       case "4":
           constructionCost.value = "197.3";
           serviceLife.value = "34";
           break;
       case "5":
           constructionCost.value = "165.4";
           serviceLife.value = "19";
           break;
       case "6":
           constructionCost.value = "165.4";
           serviceLife.value = "22";
           break;
       default:
           constructionCost.value = "";
           serviceLife.value = "";
           break;
   }
 });
});

// 12/31はここまで完了
// 標準建築費の計算をどうするか残っている







const calculate = () => {
// 変数宣言
  const calculation0 = document.querySelector('#calculation0');
  const calculation1 = document.querySelector('#calculation1');


  //入力情報に入力された数値に単位をつけて表示（スマートフォンサイズの場合にのみ表示させる）
 // 各入力フィールドに対して、changeイベントリスナーを追加します。
document.querySelector("#site_area").addEventListener('change',inputInformation);
document.querySelector("#road_price").addEventListener('change', inputInformation);
document.querySelector("#building_area").addEventListener('change', inputInformation);
document.querySelector("#building_age").addEventListener('change', inputInformation);
document.querySelector("#construction_cost").addEventListener('change', inputInformation);
document.querySelector("#service_life").addEventListener('change', inputInformation);


// ディスプレイを更新する関数
function inputInformation() {
 let site_area = document.querySelector("#site_area").value;
 let road_price = document.querySelector("#road_price").value;
 let building_area = document.querySelector('#building_area').value;
 let building_age = document.querySelector('#building_age').value;
 

 document.getElementById("lbl_site_area").innerText = site_area + "㎡";
 document.getElementById("lbl_road_price").innerText = road_price + "千円";
 document.querySelector("#lbl_building_area").innerText = building_area + "㎡";
 document.querySelector("#lbl_building_age").innerText = building_age + "年";
 document.querySelector("#lbl_construction_cost").innerText = construction_cost + "万円";
 document.querySelector("#lbl_service_life").innerText = service_life + "年";

}

// 建物構造を選択したら入力情報に挿入される関数
// ホイストとは何ぞや？　Uncaught ReferenceError: Cannot access 'building_structure' before initialization　とでたが
document.addEventListener('change', () => {
 const buildingStructureValue = document.querySelector("#building_structure").value;
 const constructionCost = document.querySelector('#construction_cost').value;
 const serviceLife = document.querySelector('#service_life').value;
 
 let structureLabel = "";
 switch (buildingStructureValue) {
 case "1":
  function resetFields() {
  updateLabelText("lbl_building_structure", "");
  updateLabelText("lbl_construction_cost", "");
  updateLabelText("lbl_service_life", "");
 }
   resetFields();
   break;
 case "2":
  structureLabel = getStructureLabel(buildingStructureValue, "鉄骨鉄筋コン(SRC造)");
   break;
 case "3":
   structureLabel = getStructureLabel(buildingStructureValue, "鉄筋コン(RC造)");
   break;
 case "4":
   structureLabel = getStructureLabel(buildingStructureValue, "鉄骨(S造)");
   break;
 case "5":
   structureLabel = getStructureLabel(buildingStructureValue, "軽量鉄骨");
   break;
 case "6":
   structureLabel = getStructureLabel(buildingStructureValue, "木造");
   break;
 default:
   break;
 }

 if( buildingStructureValue !== "1") { 
 updateLabelText("lbl_construction_cost", `${constructionCost}万円`);
 updateLabelText("lbl_service_life", `${serviceLife}年`);
 updateLabelText("lbl_building_structure", structureLabel);
 }


function getStructureLabel(buildingStructureValue, structureType) {
 return buildingStructureValue.substring(1) + structureType;
}

function updateLabelText(labelId, text) {
 document.querySelector(`#${labelId}`).innerText = text;
}

});

  //敷地面積の値を取得し変数に格納    
   let site_area = document.querySelector("#site_area").value;
   console.log(site_area);
   //路線価の値を取得し変数に格納
   let road_price = document.querySelector("#road_price").value;
   console.log(road_price);
   //建物面積の値を取得し変数に格納    
   let building_area = document.querySelector('#building_area').value;
   console.log(building_area);
   //築年数の値を取得し変数に格納    
   let building_age = document.querySelector('#building_age').value;
   console.log(building_age);
   //標準建築費の値を取得し変数に格納  
   let construction_cost = document.querySelector('#construction_cost').value;
   console.log(construction_cost);
    //耐用年数の値を取得し変数に格納 
   let service_life = document.querySelector('#service_life').value;
   console.log(service_life);
   

  // 計算ボタンの変数宣言し、クリックしたらイベント発火
  
  calculation0.addEventListener('click', calculate);
  calculation1.addEventListener('click', calculate);
  



//入力された数値を変換してもし入力値に間違っていたらアラートを出すように設定する  
  
  let site_area_value = parseFloat(site_area);
  let road_price_value = parseFloat(road_price);
  let building_area_value = parseFloat(building_area);
  let building_age_value = parseInt(building_age);
  let construction_cost_value = parseFloat(construction_cost);
  let service_life_value = parseInt(service_life);
  
  /* 物件 ********************/
  //数値が入っていない場合アラート
  if (!building_area_value) {
      alert('建物面積が空白もしくは数値以外の値です。');
      return false;
  }
  if (!building_age_value &&  building_age_value !== 0) {
      alert('築年数が空白もしくは数値以外の値です。');
      return false;
  }
  if (construction_cost_value === 0) {
      alert('建物構造を選択してください。');
      return false;
  }




//残存年数を（耐用年数ー築年数）で求める。残存年数＝耐用年数ー築年数
  let remaining_years = service_life_value - building_age_value;
  if (0 > remaining_years) {
      remaining_years = 0;
  }
  let property = (construction_cost * 10000) * (remaining_years / building_age_value) * building_age_value;
  property = Math.round(property);





/* 土地 ********************/

//数値が入っていない場合アラート
if (!site_area_value ) {
  alert('敷地面積が空白もしくは数値以外の値です。');
  return false;
}
if (!road_price_value) {
  alert('路線価が空白もしくは数値以外の値です。');
  return false;
}

// 土地の評価額を求める。（敷地面積×路線価）
let land = site_area_value * (road_price_value * 1000);
land = Math.round(land);

// 物件の評価額を日本の単位に変換
let propertyJP = toJPUnit(property);

// 土地の評価額を日本の単位に変換
let landJP = toJPUnit(land);

// 総合評価額を算出
let total = parseInt(property) + parseInt(land);

// 総合評価額を日本の単位に変換
let totalJP = toJPUnit(total);

document.querySelector("#property").innerText = '';
document.querySelector("#land").innerText = '';
document.querySelector("#comprehensive_appraisal_value").innerText = '';
document.querySelector("#property").innerText = propertyJP.toLocaleString() + "円";
document.querySelector("#land").innerText = landJP.toLocaleString() + "円";
document.querySelector("#comprehensive_appraisal_value").innerText = totalJP.toLocaleString() + "円";

window.scrollTo(0, 5000);
};

function toJPUnit(num) {
   let keta = ['', '万', '億', '兆', '京'];
   let nums = String(num).replace(/(\d)(?=(\d\d\d\d)+$)/g, "$1,").split(",").reverse();
   let data = '';
   for (var i = 0; i < nums.length; i++) {
       if (!nums[i].match(/^[0]+$/)) {
           data = nums[i].replace(/^[0]+/g, "") + keta[i] + data;
       }
   }
   return data;
}



