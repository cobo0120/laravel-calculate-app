<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="dist.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <title>不動産計算アプリ（収益・投資物件簡易収支シミュレーション）</title>
</head>

<!-- 積算評価シミュレーター -->

<body>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <header id="header">
        <nav class="bg-gray-800 w-full">
            <div class="container mx-auto px-6 py-2 flex">
                <a class="text-white md:text-2xl sm:text-sm font-semibold" href="#">収益・投資物件簡易収支シミュレーション</a>
                <button class="" type="button"></button>

                <div id="subtitle" class="ml-auto hidden sm:block">
                    <a class="text-gray-300 font-semibold nav-link"
                        href="{{ route('calculates.calc1') }}">積算評価計算シミュレーションへ</a>
                </div>
            </div>
        </nav>

        <!-- スマートフォンサイズで表示させる -->
        <div class="sm:hidden flex justify-end">
            <a class="text-blue-500 font-semibold text-xs underline"
                href="{{ route('calculates.calc1') }}">積算評価計算シミュレーションへ</a>
        </div>
    </header>

    <!-- 利回り計算機 -->
    <main>
        <div class="mt-5 container mx-auto">
            <form name="myForm">
                @csrf
                <div class="sm:flex">
                    <!--後半戦-->
                    <div class="ml-auto">
                        <div class="pt-0">
                            <div id="accordion" role="tablist" class="shadow-lg rounded-lg overflow-hidden">
                                <div class="bg-gray-50 p-4">
                                    <h5 class="font-bold">
                                        <i class="fas fa-home"></i>&nbsp;--物件情報--
                                    </h5>
                                </div>

                                <div class="border-t border-gray-200">
                                    <div class="p-10">
                                        <!-- 物件価格 -->
                                        <div class="flex items-center grid-cols-6 gap-4">
                                            <label for="bukken_bukkenkakaku"
                                                class="col-span-2 sm:col-span-2">物件価格</label>

                                            <input
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                id="bukken_bukkenkakaku" placeholder="" />

                                            <label for="bukken_bukkenkakaku" class="col-span-2 sm:col-span-2">万円</label>
                                        </div>

                                        <!-- 満室時想定年収 -->
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="bukken_manshituji"
                                                class="col-span-2 sm:col-span-2">満室時想定年収</label>

                                            <input
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                id="bukken_manshituji" placeholder="" />

                                            <label for="bukken_manshituji" class="col-span-2 sm:col-span-2">万円</label>
                                        </div>

                                        <!-- 想定空室率 -->
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="bukken_souteikuusitu"
                                                class="col-span-2 sm:col-span-2">想定空室率</label>

                                            <input
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                id="bukken_souteikuusitu" placeholder="例：10" value="">

                                            <label for="bukken_souteikuusitu"
                                                class="col-span-2 sm:col-span-2">％　</label>
                                        </div>

                                        <!-- 諸経費率 -->
                                        <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                            <label for="bukken_syokeihi" class="col-span-2 sm:col-span-2">諸経費率</label>

                                            <input
                                                class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                id="bukken_syokeihi" placeholder="例：15" value="">

                                            <label for="bukken_syokeihi" class="col-span-2 sm:col-span-2">％　</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- 縦幅の調整 -->
                                <div class="w-1/7 mr-1"></div>
                            </div>

                            <!-- 資金計画 -->
                            <div class="caret-red-50 shadow-lg rounded-lg overflow-hidden">
                                <div class="border-t border-gray-200">
                                    <div class="border-t placeholder:bg-gray-50 p-4">
                                        <h5 class="font-bold">
                                            <i class="fas fa-home"></i>&nbsp;--資金計画--
                                        </h5>
                                    </div>
                                </div>

                                <div id="collapseTwo" class="collapse show" role="tabpanel"
                                    aria-labelledby="headingTwo">
                                    <div class="card-body">
                                        <!--自己資金-->
                                        <div class="border-t p-10">
                                            <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                                <label for="shikin_jikoshikin"
                                                    class="col-span-5 sm:col-span-2">自己資金</label>

                                                <input
                                                    class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                    id="shikin_jikoshikin" placeholder="例：1000" value="">

                                                <label for="shikin_jikoshikin"
                                                    class="col-span-2 sm:col-span-2">万円</label>
                                            </div>

                                            <!-- 借入金額 -->
                                            <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                                <label for="shikin_syakunyukingaku"
                                                    class="col-span-2 sm:col-span-2">借入金額</label>

                                                <input
                                                    class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                    id="shikin_syakunyukingaku" placeholder="例：1000" value="">

                                                <label for="shikin_syakunyukingaku"
                                                    class="col-span-2 sm:col-span-2">万円</label>
                                            </div>
                                            <!-- 借入期間 -->
                                            <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                                <label for="shikin_syakunyukikan"
                                                    class="col-span-5 sm:col-span-2">借入期間</label>

                                                <input
                                                    class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                    id="shikin_syakunyukikan" placeholder="例：15" value=""
                                                    max="35" onchange="checkLoanPeriod()">

                                                <label for="shikin_syakunyukikan"
                                                    class="col-span-2 sm:col-span-2">年　</label>
                                            </div>


                                            <script>
                                                function checkLoanPeriod() {
                                                    var loanPeriod = document.getElementById("shikin_syakunyukikan").value;
                                                    if (loanPeriod > 35) {
                                                        alert("借入期間は35年までです");
                                                    }
                                                }
                                            </script>

                                            <!-- 借入金利年利 -->
                                            <div class="flex items-center grid-cols-6 gap-4 mt-5">
                                                <label for="shikin_syakunyukinri"
                                                    class="col-span-5 sm:col-span-2">借入金利　年利</label>

                                                <input
                                                    class="w-1/3 ml-auto form-input border-2 border-blue-500 rounded-lg text-center"
                                                    id="shikin_syakunyukinri" placeholder="例：3.2" step="0.01"
                                                    value="" max="10" onchange="checkInterestRate()">

                                                <label for="shikin_syakunyukinri"
                                                    class="col-span-2 sm:col-span-2">％　</label>
                                            </div>


                                            <script>
                                                function checkInterestRate() {
                                                    var interestRate = document.getElementById("shikin_syakunyukinri").value;
                                                    if (interestRate > 10) {
                                                        alert("金利は10%までです");
                                                    }
                                                }
                                            </script>

                                        </div>
                                        <!-- 縦幅の調整 -->
                                        <div class="w-1/7 mr-1"></div>
                                    </div>
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
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">物件価格</label>
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-right"
                                        id="lbl_bukken_bukkenkakaku"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">満室時想定年収</label>
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-right"
                                        id="lbl_bukken_manshituji"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">想定空室率</label>
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-right"
                                        id="lbl_bukken_souteikuusitu"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">諸経費率</label>
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-right"
                                        id="lbl_bukken_syokeihi"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">自己資金</label>
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-right"
                                        id="lbl_shikin_jikoshikin"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">借入金額</label>
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-right"
                                        id="lbl_shikin_syakunyukingaku"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">借入期間</label>
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-right"
                                        id="lbl_shikin_syakunyukikan"></label>
                                </div>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-left">借入金利　年利</label>
                                    <label class="w-1/2 sm:w-1/3 pr-0 pt-0 pb-0 text-right"
                                        id="lbl_shikin_syakunyukinri"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--右側に配置-->
                    <div class="pt-0 mr-auto">
                        <!-- 右側の計算結果表示 -->
                        <div class="card">
                            <div class="bg-gray-50 pt-4 pl-2">
                                <h5 class="font-bold">
                                    <i class="fas fa-home pl-2"></i>&nbsp;**収支計算結果**
                                </h5>
                            </div>
                            <div id="collapseFour" class="card-body pt-2 pl-10 pr-10" role="tabpanel"
                                aria-labelledby="headingTwo">

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 pr-0 pt-0 pb-0 text-left">①返済額(月額)</label>
                                    <label class="text-red-500 w-1/2 pr-0 pt-0 pb-0 text-right"
                                        id="hensaigaku_getsugaku"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    毎月の返済額
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">②返済額(年額)</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="hensaigaku_nengaku"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ①返済額(月額) × 12ヶ月
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">③返済比率</label>
                                    <label class="text-red-500  w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="hensai_hiritsu"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ②返済額(年額) ÷ ⑤家賃収入
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">④返済総額</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="hensai_sougaku"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ②返済額(年額) × 借入期間
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">⑤家賃収入(年額)</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="yachinsyunyu_nengaku"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    年間想定収入
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">⑥控除・諸経費(年額)</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="koujyosyokeihi_nengaku"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ⑤家賃収入(年額) × ( 空室率 ＋ 諸経費率 )
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">⑦年間支出</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="nenkanshisyutsu"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ②返済額(年額) ＋ ⑥控除・諸経費(年額)
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">⑧年間手取り</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="nenkantedori"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ⑤家賃収入(年額) － ⑦年間支出
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2 pr-0 pt-0 pb-0 text-left">⑨月間手取り</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="gekkantedori"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ⑧年間手取り ÷ 12ヶ月
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">⑩表面利回り</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="hyomenrimawari"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ⑤家賃収入(年額) ÷ 物件価格
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">⑪実質利回り</label>
                                    <label class="text-red-500 w-1/2 pr-0 pt-0 pb-0 text-right"
                                        id="jissiturimawari"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    (⑤家賃収入(年額) － ⑥控除・諸経費(年額)) ÷ 物件価格
                                </footer>

                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">⑫返済後利回り</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="hensaigorimawari"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ⑧年間手取り ÷ 物件価格
                                </footer>
                                <div class="flex flex-wrap mb-0">
                                    <label class="w-1/2  pr-0 pt-0 pb-0 text-left">⑬投資利回り</label>
                                    <label class="text-red-500 w-1/2  pr-0 pt-0 pb-0 text-right"
                                        id="toushirimawari"></label>
                                </div>
                                <footer class="text-left text-sm text-gray-500">
                                    ⑧年間手取り ÷ 自己資金
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- スマートフォンサイズ対応のボタン対応 -->
            <div class="flex justify-between pt-10" id="phone-footer">
                <button type="button"
                    class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded hover:bg-indigo-100 block sm:hidden ml-16"
                    id="calculation2">
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
                    id="calculation3">
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
                            const phoneFooterHidden =
                                document.getElementById("phone-footer");
                            const pcFooterHidden = document.getElementById("pc-footer");
                            // const remarksHidden = document.getElementById("remarks");
                            const hrHidden = document.getElementById("hr");
                            const footerHidden = document.getElementById("footer");

                            // headerHidden.style.visibility = "hidden";
                            subHeaderHidden.style.visibility = "hidden";
                            phoneFooterHidden.style.visibility = "hidden";
                            pcFooterHidden.style.visibility = "hidden";
                            // remarksHidden.style.visibility = "hidden";
                            hrHidden.style.visibility = "hidden";
                            footerHidden.style.visibility = "hidden";

                            window.print();

                            // headerHidden.style.visibility = "visible";
                            subHeaderHidden.style.visibility = "visible";
                            phoneFooterHidden.style.visibility = "visible";
                            pcFooterHidden.style.visibility = "visible";
                            // remarksHidden.style.visibility = "visible";
                            hrHidden.style.visibility = "visible";
                            footerHidden.style.visibility = "visible";
                        });
                </script>
            </div>
        </div>

        <!-- スマートフォンサイズで表示させる -->
        <div class="sm:hidden flex justify-end">
            <a class="text-blue-500 font-semibold" href="index.html">積算評価計算シミュレーションへ</a>
        </div>
    </main>
    <!-- js -->
    <script type="" src="{{ asset('/js/calculate2.js') }}"></script>
</body>

<hr id="hr" />
<footer id="footer" class="text-center">
    <p class="small text-center">©2023 不動産計算アプリ（仮）</p>
</footer>

</html>
