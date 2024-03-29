<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="dist.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <title>不動産計算アプリ（積算評価シミュレーター）</title>
</head>

<!-- 積算評価シミュレーター -->

<body>
    <header id="header">
        <nav class="bg-gray-800 w-full">
            <div class="container mx-auto px-6 py-2 flex">
                <a class="text-white md:text-2xl sm:text-sm font-semibold" href="#">積算評価計算シミュレーター</a>
                <button class="" type="button"></button>

                <div id="subtitle" class="ml-auto hidden sm:block">
                    <a class="text-gray-300 font-semibold nav-link"
                        href="{{ route('calculates.calc2') }}">収益・投資物件簡易収支シミュレーションへ</a>
                </div>
            </div>
        </nav>

        <!-- スマートフォンサイズで表示させる -->
        <div class="sm:hidden flex justify-end">
            <a class="text-blue-500 font-semibold text-xs underline"
                href="{{ route('calculates.calc2') }}">収益・投資物件簡易収支シミュレーションへ</a>
        </div>
    </header>

    <main>
        <div class="mt-5 container mx-auto">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <form name="myForm">
                @csrf
                <div class="sm:flex">
                    <!--左側表示-->
                    <div class="ml-auto">
                        <div class="pt-0">
                            <div id="accordion" role="tablist" class="shadow-lg rounded-lg overflow-hidden">
                                <div class="bg-gray-50 p-4">
                                    <h5 class="font-bold">
                                        <i class="fas fa-home"></i>&nbsp;--土地情報--
                                    </h5>
                                </div>

                                <div class="border-t border-gray-200">
                                    <div class="p-10">
                                        <!-- 敷地面積 -->
                                        <div class="flex items-center grid-cols-6 gap-4">
                                            <label for="site_area" class="col-span-2 sm:col-span-2">敷地面積</label>

                                            <input
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                id="site_area" placeholder="例:100" />

                                            <label for="site_area" class="col-span-2 sm:col-span-2">㎡　</label>
                                        </div>

                                        <!-- 路線価 -->
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="road_price" class="col-span-2 sm:col-span-2">路線価</label>

                                            <input
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                id="road_price" placeholder="例:100" />

                                            <label for="road_price" class="">千円</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 縦幅の調整 -->
                            <div class="w-1/7 mr-1"></div>
                        </div>

                        <!-- 建物情報 -->
                        <div class="pt-0 caret-red-50 shadow-lg rounded-lg overflow-hidden">
                            <div class="border-gray-200">
                                <div class="placeholder:bg-gray-50 p-4">
                                    <h5 class="font-bold">
                                        <i class="fas fa-home"></i>&nbsp;--建物情報--
                                    </h5>
                                </div>
                            </div>

                            <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body">
                                    <!--建物面積-->
                                    <div class="border-t p-10">
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="building_area" class="col-span-5 sm:col-span-2">建物面積</label>

                                            <input
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                id="building_area" placeholder="例:100" value="" />

                                            <label for="building_area" class="col-span-2 sm:col-span-2">㎡　</label>
                                        </div>

                                        <!-- 建物構造 -->
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="building_structure"
                                                class="col-span-2 sm:col-span-2">建物構造</label>

                                            <select id="building_structure"
                                                class="ml-auto form-input border-2 border-blue-500 rounded-lg text-center">
                                                <option value="1">選択してください</option>
                                                <option value="2">鉄骨鉄筋コン(SRC造)</option>
                                                <option value="3">鉄筋コン(RC造)</option>
                                                <option value="4">鉄骨(S造)</option>
                                                <option value="5">軽量鉄骨</option>
                                                <option value="6">木造</option>
                                                <option value="7">木造(省令)35年</option>
                                            </select>
                                        </div>
                                        <!-- 築年数 -->
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="building_age" class="col-span-5 sm:col-span-2">築年数</label>

                                            <input type="number"
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                id="building_age" placeholder="" value="">

                                            <label for="building_age" class="col-span-2 sm:col-span-2">年　</label>
                                        </div>
                                        <!-- 標準建築費 -->
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="construction_cost"
                                                class="col-span-5 sm:col-span-2">標準建築費</label>

                                            <input type="number"
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center bg-gray-200"
                                                id="construction_cost" placeholder="" step="" value=""
                                                readonly="readonly">

                                            <label for="construction_cost" class="col-span-2 sm:col-span-2">万円</label>
                                        </div>
                                        <!--耐用年数-->
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="service_life" class="col-span-5 sm:col-span-2">耐用年数</label>

                                            <input type="number"
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center bg-gray-200"
                                                id="service_life" placeholder="" step="1.0" value=""
                                                readonly="readonly">

                                            <label for="service_life" class="col-span-2 sm:col-span-2">年　</label>
                                        </div>
                                    </div>
                                    <!-- 縦幅の調整 -->
                                    <div class="h-20 w-1/7 mr-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- スマートフォンサイズのみの表示 -->
                    <div class="card sm:hidden pt-0" id="phone-collapseThree">
                        <div class="bg-gray-200 rounded-lg p-5 mb-0" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="font-bold cursor-pointer" data-toggle="collapse" href="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-home"></i>&nbsp;++入力情報++
                                </a>
                            </h5>
                        </div>

                        <div id="collapseThree" class="collapse show" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="card-body p-10">
                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pl-0 pt-0 pb-0 text-left">敷地面積</label>
                                    <label class="w-1/2 sm:w-1/3 pl-0 pt-0 pb-0 text-right"
                                        id="lbl_site_area"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">路線価</label>
                                    <label class="w-1/2 sm:w-1/3 pl-0 pt-0 pb-0 text-right"
                                        id="lbl_road_price"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">建物面積</label>
                                    <label class="w-1/2 sm:w-1/3 pl-0 pt-0 pb-0 text-right"
                                        id="lbl_building_area"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">建物構造</label>
                                    <label class="w-1/2 sm:w-1/3 pl-0 pt-0 pb-0 text-right"
                                        id="lbl_building_structure"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">築年数</label>
                                    <label class="w-1/2 sm:w-1/3 pl-0 pt-0 pb-0 text-right"
                                        id="lbl_building_age"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">標準建築費</label>
                                    <label class="w-1/2 sm:w-1/3 pl-0 pt-0 pb-0 text-right"
                                        id="lbl_construction_cost"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">耐用年数</label>
                                    <label class="w-1/2 sm:w-1/3 pl-0 pt-0 pb-0 text-right"
                                        id="lbl_service_life"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--右側表示（計算結果）-->
                    <div class="pt-0 mr-auto">
                        <div class="pt-0">
                            <div class="bg-white rounded-lg">
                                <div class="bg-white p-4 rounded-t-lg" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <p class="collapsed font-bold" href="#" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            <i class="fas fa-home"></i>&nbsp;**試算結果**
                                        </p>
                                    </h5>
                                </div>

                                <div id="collapseFour" class="show" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="p-10">

                                        <div class="flex flex-wrap mb-0">
                                            <label class="w-1/2  pr-0 pt-0 pb-0 text-left">①物件</label>
                                            <label class="w-1/2  pl-0 pt-0 pb-0 text-right" id="property"></label>
                                        </div>

                                        <div>
                                            <footer class="text-left text-sm text-gray-500">
                                                標準建築費(円/㎡) × 建物延床面積(㎡) × (耐用年数(年) -
                                                建築年(年)) ÷ 耐用年数(年)
                                            </footer>
                                        </div>


                                        <div class="flex flex-wrap mb-0">
                                            <label class="w-1/2  pr-0 pt-0 pb-0 text-left">②土地</label>
                                            <label class="w-1/2  pl-0 pt-0 pb-0 text-right" id="land"></label>
                                        </div>

                                        <div>
                                            <footer class="text-left text-sm text-gray-500">
                                                敷地面積 × 路線価
                                            </footer>
                                        </div>


                                        <div class="flex flex-wrap mb-0">
                                            <label class="w-1/2  pr-0 pt-0 pb-0 text-left">③総合評価額</label>
                                            <label class="w-1/2  pl-0 pt-0 pb-0 text-right"
                                                id="comprehensive_appraisal_value"></label>
                                        </div>

                                        <div>
                                            <footer class="text-left text-sm text-gray-500">
                                                ①物件 + ②土地
                                            </footer>
                                        </div>
                                        <!-- 縦幅で調整 -->
                                        <div class="w-1/7 mr-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- スマートフォンサイズ対応のボタン対応 -->
            <div class="flex justify-between" id="phone-footer">
                <button type="button"
                    class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded hover:bg-indigo-100 block sm:hidden ml-16"
                    id="calculation0" onclick="">
                    計算する
                </button>

                <div class="">
                    <button type="button"
                        class="px-2 py-1 text-yellow-500 border border-yellow-500 font-semibold rounded hover:bg-yellow-100 block sm:hidden mr-16"
                        id="reset">
                        リセット
                    </button>
                </div>

                <!-- <div class="">
             <button id="print" type="button"
              class="px-2 py-1 text-red-500 border border-red-500 font-semibold rounded hover:bg-yellow-100 mr-20 block sm:hidden"
              id="print">印刷する</button>
            </div> -->
            </div>

            <!-- PC対応のボタン配置 -->
            <div class="flex justify-between m-10" id="pc-footer">
                <button type="button"
                    class="px-10 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded hover:bg-indigo-100 mr-20 hidden sm:block"
                    id="calculation1" onclick="">
                    計算する
                </button>

                <div class="">
                    <button type="button"
                        class="px-10 py-1 text-yellow-500 border border-yellow-500 font-semibold rounded hover:bg-yellow-100 mr-20 hidden sm:block"
                        id="reset" onclick="resetForm();">
                        リセット
                    </button>
                </div>

                <div class="">
                    <button id="print" type="button"
                        class="px-10 py-1 text-red-500 border border-red-500 font-semibold rounded hover:bg-yellow-100 mr-20 hidden sm:block">
                        印刷する
                    </button>
                </div>
            </div>

            <!-- 印刷と数値入力リセットする入力方法 -->
            <script>
                function resetForm() {
                    document.forms["myForm"].reset();
                }
            </script>

            <!-- 特定の印刷範囲の設定 -->
            <script>
                document
                    .getElementById("print")
                    .addEventListener("click", function() {
                        // const headerHidden = document.getElementById('header');
                        const subHeaderHidden = document.getElementById("subtitle");
                        const phoneFooterHidden = document.getElementById("phone-footer");
                        const pcFooterHidden = document.getElementById("pc-footer");
                        const remarksHidden = document.getElementById("remarks");
                        const hrHidden = document.getElementById("hr");
                        const footerHidden = document.getElementById("footer");

                        // headerHidden.style.visibility = "hidden";
                        subHeaderHidden.style.visibility = "hidden";
                        phoneFooterHidden.style.visibility = "hidden";
                        pcFooterHidden.style.visibility = "hidden";
                        remarksHidden.style.visibility = "hidden";
                        hrHidden.style.visibility = "hidden";
                        footerHidden.style.visibility = "hidden";

                        window.print();

                        // headerHidden.style.visibility = "visible";
                        subHeaderHidden.style.visibility = "visible";
                        phoneFooterHidden.style.visibility = "visible";
                        pcFooterHidden.style.visibility = "visible";
                        remarksHidden.style.visibility = "visible";
                        hrHidden.style.visibility = "visible";
                        footerHidden.style.visibility = "visible";
                    });
            </script>

            <!--備考 -->
            <div id="remarks" class="mt-10 p-10">
                <!-- タブボタン部分 -->
                <ul class="flex border-b">
                    <li class="nav-item">
                        <p class="nav-link active border-transparent border-b-2 text-blue-500" data-toggle="tab">
                            備考
                        </p>
                    </li>
                </ul>

                <!--タブのコンテンツ部分-->
                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">
                        <p class="pt-2">
                            ※<a href="https://www.rosenka.nta.go.jp/" target="_blank"
                                class="text-blue-500 underline">路線価図・評価倍率表（国税庁）</a>の情報を使用<br />※耐用年数：建物構造から自動で計算<br />※標準建築費：建物構造から自動で計算
                        </p>
                        <div class="alert alert-info" role="alert">
                            <table class="table-auto m-3">
                                <tbody class="">
                                    <tr>
                                        <td class="text-start font-small font-bold">
                                            ・耐用年数
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left w-auto">
                                            SRC・RC造：47年、鉄骨造：34年
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left w-auto">
                                            軽量鉄骨造：19年、木造：22年
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- <table class="table-auto m-3">
                                <tbody>
                                    <tr>
                                        <td class="text-start font-small font-bold">
                                            ・標準建築費(円/㎡)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left w-auto">
                                            SRC造：262.2万、RC造：240.2万、鉄骨造：197.3万
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left w-auto">
                                            軽量鉄骨造：165.4万、木造：165.4万
                                        </td>
                                    </tr>
                                </tbody>
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- スマートフォンサイズで表示させる -->
        <div class="sm:hidden flex justify-end">
            <a class="text-blue-500 font-semibold" href="calculate_ver4.html">収益・投資物件簡易収支シミュレーションへ</a>
        </div>
    </main>
    <!-- js -->
    {{-- <script src="{{ asset('/js/.js') }}"></script> --}}
    <script type="" src="{{ asset('/js/building.js') }}"></script>
    <script type="" src="{{ asset('/js/calculate.js') }}"></script>
</body>

<hr id="hr" />
<footer id="footer" class="text-center">
    <p class="small text-center">©2023 不動産計算アプリ（仮）</p>
</footer>

</html>
