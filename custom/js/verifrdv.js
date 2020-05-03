$(function () {
//    if(todayHeureMinute()>="11:18"){
//        
//    alert(todayHeureMinute());
//    }

    setInterval(function () {
        reg();
    }, 30000
            );

    //reg();

    function heureMaintenant() {
        var ade = new Date();
        return ade.getHours() + ":" + ade.getMinutes();
    }


    function today() {
        var date = new Date(),
                jour = date.getDate(),
                mois = date.getMonth() + 1,
                annee = date.getFullYear();

        if (mois < 10)
            mois = "0" + mois;

        var d = annee + "-" + mois + "-" + jour;

        return d;
    }

    function todayHeureMinute(dat = new Date()) {

        var date = new Date(dat),
                heure = date.getHours(),
                minute = date.getMinutes();

        if (heure < 10)
            heure = "0" + heure;

        if (minute < 10)
            minute = "0" + minute;

        var d = heure + ":" + minute;

        return d;
    }


    function reg() {
        $.ajax({
            url: "http://localhost:81/kabostock/app.php",
            method: "POST",
            data: {rdv: 1},
            dataType: "json",
            success: function (res) {
                $.each(res, function (i, v) {
                    if (today() === v[5]) {
                        if (todayHeureMinute(addMinute(10)) === v[6]) {
                            $.notify('Vous avez un rendez-vous dans 10 minutes avec ' + v[1],
                                    {
                                        className: "info",
                                        globalPosition: 'top center',
                                    }
                            );
                            //*/
                        } else if (todayHeureMinute() <= v[6]) {
                            $.notify('Vous avez un rendez-vous à ' + v[6] + ' avec ' + v[1],
                                    {
                                        className: "info",
                                        globalPosition: 'top center',
                                    }
                            );
                        }

                    }
                });
            }
        });
    }

    function dv() {
        for (var i = 2; i <= 12; i++) {
            var pre = i - 1,
                    dp = $("#d" + pre + "v").val(),
                    date = addDaysDate(dp, fp),
                    jour = date.getDate(),
                    mois = date.getMonth() + 1,
                    annee = date.getFullYear();

            if (mois < 10) {
                mois = "0" + mois;
            }

            var d = annee + "-" + mois + "-" + jour;
            $("#d" + i + "v").val(d);
        }

    }

    function addDaysDate(date, duree) {
        return new Date(new Date(date).getTime() + parseInt(duree) * 24 * 60 * 60 * 1000);
    }

    function addMinute(duree) {
        return new Date().getTime() + parseInt(duree) * 60 * 1000;
    }
});