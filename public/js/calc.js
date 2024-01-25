var src = 180000;
var rc = 180000;
var s = 150000;
var keitetsu = 130000;
var mokuzou = 130000;

$(function () {
    //セレクトボックス切り替え処理
    $('#kouzou').change(function () {
        var val = $(this).val();
        switch (val) {
            case "1":
                $("#hiyou").val("18");
                $("#nensu").val("47");
                break;
            case "2":
                $("#hiyou").val("18");
                $("#nensu").val("47");
                break;
            case "3":
                $("#hiyou").val("15");
                $("#nensu").val("34");
                break;
            case "4":
                $("#hiyou").val("13");
                $("#nensu").val("19");
                break;
            case "5":
                $("#hiyou").val("13");
                $("#nensu").val("22");
                break;
            default:
                $("#hiyou").val("");
                $("#nensu").val("");
                break;
        }
    });

    $('#calculation0,#calculation1').click(function () {

        var saichoutatu_genka = "";
        var saichoutatu_value = "";
        var tochi_menseki = $("#tochi_menseki").val();
        var tochi_rosenka = $("#tochi_rosenka").val();
        var tatemono_menseki = $('#menseki').val();
        var tatemono_kouzou = $('#kouzou').val();
        var tatemono_tikunensu = $('#tikunensu').val();
        var tatemono_hiyou = $('#hiyou').val();
        var tatemono_nensu = $('#nensu').val();

        switch (tatemono_kouzou) {
            case "1":
                saichoutatu_genka = src;
                saichoutatu_value = "鉄骨鉄筋コンクリート造(SRC造)";
                break;
            case "2":
                saichoutatu_genka = rc;
                saichoutatu_value = "鉄骨コンクリート造(RC造)";
                break;
            case "3":
                saichoutatu_genka = s;
                saichoutatu_value = "鉄骨造(S造)";
                break;
            case "4":
                saichoutatu_genka = keitetsu;
                saichoutatu_value = "軽量鉄骨造";
                break;
            case "5":
                saichoutatu_genka = mokuzou;
                saichoutatu_value = "木造";
                break;
            default:
                saichoutatu_genka = 0;
                saichoutatu_value = "";
                break;
        }

        $("#lbl_tochi_menseki").text(tochi_menseki + "㎡");
        $("#lbl_tochi_rosenka").text(tochi_rosenka + "千円");
        $("#lbl_menseki").text(tatemono_menseki + "㎡");
        $("#lbl_kouzou").text(saichoutatu_value + "");
        $("#lbl_tikunensu").text(tatemono_tikunensu + "年");
        $("#lbl_hiyou").text(tatemono_hiyou + "万円");
        $("#lbl_nensu").text(tatemono_nensu + "年");

        saichoutatu_genka = parseInt(saichoutatu_genka);
        tatemono_menseki = parseFloat(tatemono_menseki);
        tatemono_tikunensu = parseInt(tatemono_tikunensu);
        tatemono_hiyou = parseFloat(tatemono_hiyou);
        tatemono_nensu = parseInt(tatemono_nensu);

        tochi_menseki = parseFloat(tochi_menseki);
        tochi_rosenka = parseFloat(tochi_rosenka);

        /* 物件 ********************/
        //数値が入っていない場合アラート
        if (!tatemono_menseki) {
            alert('建物面積が空白もしくは数値以外の値です。');
            return false;
        }
        if (!tatemono_tikunensu && tatemono_tikunensu !== 0) {
            alert('築年数が空白もしくは数値以外の値です。');
            return false;
        }
        if (saichoutatu_genka === 0) {
            alert('建物構造を選択してください。');
            return false;
        }

        var zanzon_nensu = tatemono_nensu - tatemono_tikunensu;
        if (0 > zanzon_nensu) {
            zanzon_nensu = 0;
        }
        var bukken = saichoutatu_genka * (zanzon_nensu / tatemono_nensu) * tatemono_menseki;
        bukken = Math.round(bukken);
        var bukken_view = toJPUnit(bukken);

        /* 土地 ********************/

        //数値が入っていない場合アラート
        if (!tochi_menseki) {
            alert('敷地面積が空白もしくは数値以外の値です。');
            return false;
        }
        if (!tochi_rosenka) {
            alert('路線価が空白もしくは数値以外の値です。');
            return false;
        }

        var tochi = tochi_menseki * (tochi_rosenka * 1000);
        tochi = Math.round(tochi);
        var tochi_view = toJPUnit(tochi);

        var total = parseInt(bukken) + parseInt(tochi);
        var total_view = toJPUnit(total);

        $("#bukken").text(bukken_view + "円");
        $("#tochi").text(tochi_view + "円");
        $("#hyouka").text(total_view + "円");

        window.scrollTo(0, 5000);
    });

    // テキストボックスにフォーカス時、フォームの背景色を変化
    $('#shikin_jikoshikin').focusout(function (e) {

        var bukken_bukkenkakaku = $('#bukken_bukkenkakaku').val();
        var shikin_jikoshikin = $('#shikin_jikoshikin').val();
        var shikin_syakunyukingaku = $('#shikin_syakunyukingaku').val();

        if (bukken_bukkenkakaku === '' || bukken_bukkenkakaku === 0) {
            return;
        }

        wk_bukken_bukkenkakaku = parseFloat(bukken_bukkenkakaku);
        wk_shikin_jikoshikin = parseFloat(shikin_jikoshikin);
        wk_shikin_syakunyukingaku = parseFloat(shikin_syakunyukingaku);

        wk_shikin_syakunyukingaku = wk_bukken_bukkenkakaku - wk_shikin_jikoshikin;
        $("#shikin_syakunyukingaku").val(wk_shikin_syakunyukingaku);
    });

    // テキストボックスにフォーカス時、フォームの背景色を変化
    $('#shikin_jikoshikin, #shikin_syakunyukingaku').focusout(function (e) {

        var bukken_bukkenkakaku = $('#bukken_bukkenkakaku').val();
        var shikin_jikoshikin = $('#shikin_jikoshikin').val();
        var shikin_syakunyukingaku = $('#shikin_syakunyukingaku').val();

        if (bukken_bukkenkakaku === '' || bukken_bukkenkakaku === 0) {
            return;
        }

        wk_bukken_bukkenkakaku = parseFloat(bukken_bukkenkakaku);
        wk_shikin_jikoshikin = parseFloat(shikin_jikoshikin);
        wk_shikin_syakunyukingaku = parseFloat(shikin_syakunyukingaku);

        wk_shikin_jikoshikin = wk_bukken_bukkenkakaku - wk_shikin_syakunyukingaku;
        $("#shikin_jikoshikin").val(wk_shikin_jikoshikin);
    });


    $('#calculation2,#calculation3').click(function () {

        var bukken_bukkenkakaku = $('#bukken_bukkenkakaku').val();
        var bukken_manshituji = $('#bukken_manshituji').val();
        var bukken_souteikuusitu = $('#bukken_souteikuusitu').val();
        var bukken_syokeihi = $('#bukken_syokeihi').val();

        var shikin_jikoshikin = $('#shikin_jikoshikin').val();
        var shikin_syakunyukingaku = $('#shikin_syakunyukingaku').val();
        var shikin_syakunyukikan = $('#shikin_syakunyukikan').val();
        var shikin_syakunyukinri = $('#shikin_syakunyukinri').val();

        $("#lbl_bukken_bukkenkakaku").text(bukken_bukkenkakaku + "万円");
        $("#lbl_bukken_manshituji").text(bukken_manshituji + "万円");
        $("#lbl_bukken_souteikuusitu").text(bukken_souteikuusitu + "％");
        $("#lbl_bukken_syokeihi").text(bukken_syokeihi + "％");
        $("#lbl_shikin_jikoshikin").text(shikin_jikoshikin + "万円");
        $("#lbl_shikin_syakunyukingaku").text(shikin_syakunyukingaku + "万円");
        $("#lbl_shikin_syakunyukikan").text(shikin_syakunyukikan + "年");
        $("#lbl_shikin_syakunyukinri").text(shikin_syakunyukinri + "％");

        wk_bukken_bukkenkakaku = parseFloat(bukken_bukkenkakaku);
        wk_shikin_syakunyukingaku = parseFloat(shikin_syakunyukingaku);
        wk_shikin_syakunyukinri = parseFloat(shikin_syakunyukinri);
        wk_shikin_syakunyukikan = parseFloat(shikin_syakunyukikan);
        wk_bukken_manshituji = parseFloat(bukken_manshituji);
        wk_bukken_syokeihi = parseFloat(bukken_syokeihi);
        wk_bukken_souteikuusitu = parseFloat(bukken_souteikuusitu);
        wk_shikin_jikoshikin = parseFloat(shikin_jikoshikin);

        bukken_bukkenkakaku = wk_bukken_bukkenkakaku * 10000;
        shikin_syakunyukingaku = wk_shikin_syakunyukingaku * 10000;
        shikin_syakunyukinri = wk_shikin_syakunyukinri / 100;
        shikin_syakunyukikan = wk_shikin_syakunyukikan * 12;
        bukken_souteikuusitu = wk_bukken_souteikuusitu * 100000;
        bukken_manshituji = wk_bukken_manshituji * 10000;
        shikin_jikoshikin = wk_shikin_jikoshikin * 10000;

        var hensaigaku_getsugaku;
        var hensaigaku_nengaku;
        var hensai_sougaku;
        var nenkanshisyutsu;
        var nenkantedori;
        var hyomenrimawari;
        var jissiturimawari;
        var hensaigorimawari;
        var hensai_hiritsu;
        var toushirimawari;
        var koujyosyokeihi_nengaku;

        //毎月返済額
        {
            wk_bunsi = shikin_syakunyukingaku * (shikin_syakunyukinri / 12) * Math.pow((1 + (shikin_syakunyukinri / 12)), shikin_syakunyukikan);
            wk_bunbo = Math.pow((1 + (shikin_syakunyukinri / 12)), shikin_syakunyukikan) - 1;
            hensaigaku_getsugaku = Math.ceil(wk_bunsi / wk_bunbo);
            $("#hensaigaku_getsugaku").text(toJPUnit(hensaigaku_getsugaku) + "円");
        }

        //年間返済額
        {
            hensaigaku_nengaku = hensaigaku_getsugaku * 12;
            $("#hensaigaku_nengaku").text(toJPUnit(hensaigaku_nengaku) + "円");
        }

        //返済比率
        {
            hensai_hiritsu = (hensaigaku_nengaku / bukken_manshituji) * 100;
            $("#hensai_hiritsu").text(hensai_hiritsu.toFixed(2) + "％");
        }

        //返済額合計
        {
            wk_m_zandaka = shikin_syakunyukingaku;
            mon_zandaka = 100 * Math.floor(wk_m_zandaka / 100);
            wk_b_zandaka = 0;
            bon_zandaka = 100 * Math.floor(wk_b_zandaka / 100);
            wk_m_zandaka = mon_zandaka;
            wk_b_zandaka = bon_zandaka;
            wk_zandaka = mon_zandaka + bon_zandaka;
            wk_kaisu = shikin_syakunyukikan;

            //	毎月返済元金合計
            tot_m_gankin = shikin_syakunyukingaku;

            //	ボーナス返済元金合計
            tot_b_gankin = 0;

            //	毎月返済＆ボーナス返済利息合計
            tot_m_risoku = 0;
            tot_b_risoku = 0;
            for (i = 1; i <= wk_kaisu; i++) {
                wk_m_risoku = m_risoku_calc(wk_m_zandaka, shikin_syakunyukinri);
                tot_m_risoku = tot_m_risoku + wk_m_risoku;
                wk_m_gankin = hensaigaku_getsugaku - wk_m_risoku;
                wk_m_zandaka = wk_m_zandaka - wk_m_gankin;
                if (i % 6 === 0) {
                    wk_b_risoku = b_risoku_calc(wk_b_zandaka, shikin_syakunyukinri);
                    tot_b_risoku = tot_b_risoku + wk_b_risoku;
                    wk_b_gankin = wk_b_risoku;
                    wk_b_zandaka = wk_b_zandaka - wk_b_gankin;
                    wk_m_hensai = hensaigaku_getsugaku + wk_b_risoku + wk_b_gankin;
                }
                else {
                    wk_m_hensai = hensaigaku_getsugaku;
                }
            }
            hensai_sougaku = tot_m_gankin + tot_b_gankin + tot_m_risoku + tot_b_risoku;
            $("#hensai_sougaku").text(toJPUnit(hensai_sougaku) + "円");
        }

        //年間想定収入
        {
            $("#yachinsyunyu_nengaku").text(toJPUnit(bukken_manshituji) + "円");
        }

        //空室控除・諸経費
        {
            koujyosyokeihi_nengaku = Math.ceil(bukken_manshituji * wk_bukken_souteikuusitu / 100) + Math.ceil(bukken_manshituji * wk_bukken_syokeihi / 100);
            $("#koujyosyokeihi_nengaku").text(toJPUnit(koujyosyokeihi_nengaku) + "円");
        }

        // 年間支出
        {
            nenkanshisyutsu = Math.ceil(hensaigaku_nengaku) + Math.ceil(koujyosyokeihi_nengaku);
            $("#nenkanshisyutsu").text(toJPUnit(nenkanshisyutsu) + "円");
        }

        // 年間手取り
        {
            nenkantedori = bukken_manshituji - hensaigaku_nengaku - koujyosyokeihi_nengaku;
            $("#nenkantedori").text(toJPUnit(nenkantedori) + "円");
        }

        // 月間手取り
        {
            $("#gekkantedori").text(toJPUnit((nenkantedori / 12).toFixed(0)) + "円");
        }

        // 表面利回り
        {
            hyomenrimawari = (bukken_manshituji / bukken_bukkenkakaku) * 100;
            hyomenrimawari = (Math.round(hyomenrimawari * 100)) / 100;
            $("#hyomenrimawari").text(hyomenrimawari + "％");
        }

        // 実質利回り
        {
            jissiturimawari = ((bukken_manshituji - koujyosyokeihi_nengaku) / bukken_bukkenkakaku) * 100;
            jissiturimawari = (Math.round(jissiturimawari * 100)) / 100;
            $("#jissiturimawari").text(jissiturimawari + "％");
        }

        // 返済後利回り
        {
            hensaigorimawari = (nenkantedori / bukken_bukkenkakaku) * 100;
            hensaigorimawari = (Math.round(hensaigorimawari * 100)) / 100;
            $("#hensaigorimawari").text(hensaigorimawari + "％");
        }

        // 投資利回り
        {
            if ((bukken_bukkenkakaku - shikin_syakunyukingaku) === 0) {
                toushirimawari = 0;
            } else {
                toushirimawari = (nenkantedori / shikin_jikoshikin) * 100;
                toushirimawari = (Math.round(toushirimawari * 100)) / 100;
            }
            $("#toushirimawari").text(toushirimawari + "％");

        }
    });
});

// 数字に桁表示
function toJPUnit(num) {
    var keta = ['', '万', '億', '兆', '京'];
    var nums = String(num).replace(/(\d)(?=(\d\d\d\d)+$)/g, "$1,").split(",").reverse();
    var data = '';
    for (var i = 0; i < nums.length; i++) {
        if (!nums[i].match(/^[0]+$/)) {
            data = nums[i].replace(/^[0]+/g, "") + keta[i] + data;
        }
    }
    return data;
}

//毎月返済利息の計算
function m_risoku_calc(zandaka, shikin_syakunyukinri) {
    zandaka = 100 * Math.floor(zandaka / 100);
    m_risoku = Math.floor(zandaka * shikin_syakunyukinri / 12);
    return (m_risoku);
}
//ボーナス返済利息の計算
function b_risoku_calc(zandaka, shikin_syakunyukinri) {
    zandaka = 100 * Math.floor(zandaka / 100);
    b_risoku = Math.floor(zandaka * shikin_syakunyukinri / 2);
    return (b_risoku);
}