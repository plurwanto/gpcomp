var Index = function () {

    var runChartOmzetByQty = function () {
        var currentYear = (new Date).getFullYear();
        $('#tahun_ini').text(currentYear);
        //  alert(tahun_ini);
        $('.dropdown-menu li').click(function () {
            var thn = $(this).attr("value");
            get_tahun(thn);
            $('#tahun_ini').text(thn);
        });

        get_tahun($('#tahun_ini').text());

        function get_tahun(val) {
            $.ajax({
                url: "home/getTotalPenjualanByYear/" + val,
                dataType: 'json',
                method: 'GET',
                success: function (response) {
                    var data_omzet = [],
                            series = response.data.length;

                    for (var i = 0; i < series; i++) {
                        data_omzet[i] = [response.data[i].Bulan + "<br>Margin: " + response.data[i].TotJual.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"), response.data[i].TotQty];
                    }

                    $.plot("#placeholder5", [data_omzet], {
                        series: {
                            bars: {
                                show: true,
                                barWidth: 0.5,
                                align: "center",
                                fillColor: "#428BCA",
                                lineWidth: 1,
                            }
                        },
                        xaxis: {
                            mode: "categories",
                            tickLength: 0
                        },
                        lines: {show: true},
                        grid: {hoverable: true, clickable: true}
                    });
                    $("#label_thn").text(response.thn);

                    var previousPoint = null;
                    $("#placeholder5").bind("plothover", function (event, pos, item) {
                        $("#x").text(pos.x);
                        $("#y").text(pos.y);
                        if (item) {
                            if (previousPoint != item.dataIndex) {
                                previousPoint = item.dataIndex;
                                $("#tooltip").remove();
                                var x = item.datapoint[0],
                                        y = item.datapoint[1],
                                        z = item.datapoint[2];

                                for (var i = 0; i < series; i++) {
                                    data_omzet[i] = [response.data[i].Bulan];
                                }

                                showTooltip(item.pageX, item.pageY, "Penjualan" + " Bulan " + data_omzet[x] + " = " + y);
                            }
                        } else {
                            $("#tooltip").remove();
                            previousPoint = null;
                        }
                    });
                }

            });
        }
    };

    var runChartOmzetByPerItem = function () {

        var currentYear = (new Date).getFullYear();
        $('#tahun_ini2').text(currentYear);
        //  alert(tahun_ini);
        $('.dropdown-menu li').click(function () {
            var thn2 = $(this).attr("value");
            get_tahun2(thn2);
            $('#tahun_ini2').text(thn2);
        });

        get_tahun2($('#tahun_ini2').text());

        function get_tahun2(val) {
            $.ajax({
                url: "home/getTotalPenjualanDetailByYear/" + val,
                dataType: 'json',
                method: 'GET',
                success: function (response) {
                    var data_omzet = [], data_produk = [], data_omzet_new = [],
                            series = response.data.length;

                    // var nmproduk = [];
                    for (var i = 0; i < series; i++) {
                        data_produk[i] = [response.data[i].NamaProduk];
                        data_omzet[i] = [response.data[i].TotQty.toString().split(",")];//[response.data[i].TotQty];

                    }
                  //  alert(data_omzet.length);

                    var d = (data_omzet.length > 0 ? data_omzet[0].toString().split(",") : "");
                    var e = (data_omzet.length > 1 ? data_omzet[1].toString().split(",") : ""); 
                    var f = (data_omzet.length > 2 ? data_omzet[2].toString().split(",") : "");
                    var g = (data_omzet.length > 3 ? data_omzet[3].toString().split(",") : "");
                    var h = (data_omzet.length > 4 ? data_omzet[4].toString().split(",") : "");
                    
                    //alert(response.thn);
                    $.plot("#placeholder6", [
                        {
                            color: "blue",
                            label: data_produk[0],
                            data: [[1, d[0]], [2, d[1]], [3, d[2]], [4, d[3]], [5, d[4]], [6, d[5]], [7, d[6]], [8, d[7]], [9, d[8]], [10, d[9]], [11, d[10]], [12, d[11]]]
                        },
                        {
                            color: "cyan",
                            label: data_produk[1],
                            data: [[1, e[0]], [2, e[1]], [3, e[2]], [4, e[3]], [5, e[4]], [6, e[5]], [7, e[6]], [8, e[7]], [9, e[8]], [10, e[9]], [11, e[10]], [12, e[11]]]
                        },
                        {
                            color: "red",
                            label: data_produk[2],
                            data: [[1, f[0]], [2, f[1]], [3, f[2]], [4, f[3]], [5, f[4]], [6, f[5]], [7, f[6]], [8, f[7]], [9, f[8]], [10, f[9]], [11, f[10]], [12, f[11]]]
                        },
                        {
                            color: "purple",
                            label: data_produk[3],
                            data: [[1, g[0]], [2, g[1]], [3, g[2]], [4, g[3]], [5, g[4]], [6, g[5]], [7, g[6]], [8, g[7]], [9, g[8]], [10, g[9]], [11, g[10]], [12, g[11]]]
                        },
                        {
                            color: "yellow",
                            label: data_produk[4],
                            data: [[1, h[0]], [2, h[1]], [3, h[2]], [4, h[3]], [5, h[4]], [6, h[5]], [7, h[6]], [8, h[7]], [9, h[8]], [10, h[9]], [11, h[10]], [12, h[11]]]
                        }

                    ], {
                        series: {
                            bars: {
                                show: true,
                                barWidth: 0.15,
                                align: "center",
                                order: 1
                            }
                        },
                        xaxis: {
                            mode: "categories",
                            ticks: [
                                [0, "Januari"],
                                [1, "Februari"],
                                [2, "Maret"],
                                [3, "April"],
                                [4, "Mei"],
                                [5, "Juni"],
                                [6, "Juli"],
                                [7, "Agustus"],
                                [8, "September"],
                                [9, "Oktober"],
                                [10, "November"],
                                [11, "Desember"],
                            ],
                            tickLength: 1,

                        },
                        grid: {
                            hoverable: true,
                        },
                        yAxis: {
                            allowDecimals: false,
                        }
                    });
                    $("#label_thn2").text(response.thn2);

                    var previousPoint = null;
                    $("#placeholder6").bind("plothover", function (event, pos, item) {
                        $("#x").text(pos.x);
                        $("#y").text(pos.y);
                        if (item) {
                            if (previousPoint != item.dataIndex) {
                                previousPoint = item.dataIndex;
                                $("#tooltip").remove();
                                var x = item.datapoint[0],
                                        y = item.datapoint[1],
                                        z = item.datapoint[2];

//                                for (var i = 0; i < series; i++) {
//                                    data_omzet[i] = [response.data[i].Bulan];
//                                }
                                //showTooltip(item.pageX, item.pageY, "Penjualan" + " Bulan " + data_omzet[x] + " = " + y);
                                showTooltip(item.pageX, item.pageY, y);
                            }
                        } else {
                            $("#tooltip").remove();
                            previousPoint = null;
                        }
                    });
                }

            });
        }

    };

    // function to initiate Chart 2 Produk Terlaris berdasarkan Tahun
    var runChartProdukTerlaris = function () {
        $.ajax({
            url: "home/getProdukTerlaris",
            dataType: 'json',
            method: 'GET',
            success: function (response) {
                var data_pie = [],
                        series = response.data.length;

                for (var i = 0; i < series; i++) {
                    data_pie[i] = {
                        label: response.data[i].NamaProduk,
                        data: response.data[i].Jumlah
                    };
                }

                $.plot('#placeholder-h2', data_pie, {
                    series: {
                        pie: {
                            show: true, radius: 100,
                            label: {
                                show: true, radius: 0.4, formatter: labelFormatter,
                            },
                            data: {show: true}
                        }
                    },
                    grid: {
                        hoverable: true,
                        clickable: true
                    },
                    legend: {show: true, radius: "auto"}
                });

                $("#placeholder-h2").bind("plotclick", function (event, pos, obj) {
                    if (!obj) {
                        return;
                    }
                    percent = parseFloat(obj.series.percent).toFixed(2);
                    alert("" + obj.series.label + ": " + percent + "%");
                });

                function labelFormatter(label, series) {
                    return "<div style='font-size:10pt; color:white;'>" + Math.round(series.percent) + "%</div>";
                }
            }
        });
    };

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 15,
            border: '1px solid #333',
            padding: '4px',
            color: '#fff',
            'border-radius': '3px',
            'background-color': '#333',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    // function to initiate Chart 1
    var runChart1 = function () {
        function randValue() {
            return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        }
        ;
        var pageviews = [
            [1, randValue()],
            [2, randValue()],
            [3, 2 + randValue()],
            [4, 3 + randValue()],
            [5, 5 + randValue()],
            [6, 10 + randValue()],
            [7, 15 + randValue()],
            [8, 20 + randValue()],
            [9, 25 + randValue()],
            [10, 30 + randValue()],
            [11, 35 + randValue()],
            [12, 25 + randValue()],
            [13, 15 + randValue()],
            [14, 20 + randValue()],
            [15, 45 + randValue()],
            [16, 50 + randValue()],
            [17, 65 + randValue()],
            [18, 70 + randValue()],
            [19, 85 + randValue()],
            [20, 80 + randValue()],
            [21, 75 + randValue()],
            [22, 80 + randValue()],
            [23, 75 + randValue()],
            [24, 70 + randValue()],
            [25, 65 + randValue()],
            [26, 75 + randValue()],
            [27, 80 + randValue()],
            [28, 85 + randValue()],
            [29, 90 + randValue()],
            [30, 95 + randValue()]
        ];
        var visitors = [
            [1, randValue() - 5],
            [2, randValue() - 5],
            [3, randValue() - 5],
            [4, 6 + randValue()],
            [5, 5 + randValue()],
            [6, 20 + randValue()],
            [7, 25 + randValue()],
            [8, 36 + randValue()],
            [9, 26 + randValue()],
            [10, 38 + randValue()],
            [11, 39 + randValue()],
            [12, 50 + randValue()],
            [13, 51 + randValue()],
            [14, 12 + randValue()],
            [15, 13 + randValue()],
            [16, 14 + randValue()],
            [17, 15 + randValue()],
            [18, 15 + randValue()],
            [19, 16 + randValue()],
            [20, 17 + randValue()],
            [21, 18 + randValue()],
            [22, 19 + randValue()],
            [23, 20 + randValue()],
            [24, 21 + randValue()],
            [25, 14 + randValue()],
            [26, 24 + randValue()],
            [27, 25 + randValue()],
            [28, 26 + randValue()],
            [29, 27 + randValue()],
            [30, 31 + randValue()]
        ];
        var plot = $.plot($("#placeholder-h1"), [{
                data: pageviews,
                label: "Unique Visits"
            }, {
                data: visitors,
                label: "Page Views"
            }], {
            series: {
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                                opacity: 0.05
                            }, {
                                opacity: 0.01
                            }]
                    }
                },
                points: {
                    show: false
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#eee",
                borderWidth: 0
            },
            colors: ["#d12610", "#37b7f3", "#52e136"],
            xaxis: {
                ticks: 11,
                tickDecimals: 0
            },
            yaxis: {
                ticks: 11,
                tickDecimals: 0
            }
        });

        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 15,
                border: '1px solid #333',
                padding: '4px',
                color: '#fff',
                'border-radius': '3px',
                'background-color': '#333',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }
        var previousPoint = null;
        $("#placeholder-h1").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2);
                    showTooltip(item.pageX, item.pageY, item.series.label + " of " + x + " = " + y);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    };

    // function to initiate Chart 3
    var runChart3 = function () {
        var data = [],
                totalPoints = 300;

        function getRandomData() {
            if (data.length > 0)
                data = data.slice(1);
            // Do a random walk
            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50,
                        y = prev + Math.random() * 10 - 5;
                if (y < 0) {
                    y = 0;
                } else if (y > 100) {
                    y = 100;
                }
                data.push(y);
            }
            // Zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }
            return res;
        }
        // Set up the control widget
        var updateInterval = 30;
        $("#updateInterval").val(updateInterval).change(function () {
            var v = $(this).val();
            if (v && !isNaN(+v)) {
                updateInterval = +v;
                if (updateInterval < 1) {
                    updateInterval = 1;
                } else if (updateInterval > 2000) {
                    updateInterval = 2000;
                }
                $(this).val("" + updateInterval);
            }
        });
        var plot = $.plot("#placeholder-h3", [getRandomData()], {
            grid: {
                borderWidth: 1,
                borderColor: '#eeeeee'
            },
            series: {
                shadowSize: 0 // Drawing is faster without shadows
            },
            yaxis: {
                min: 0,
                max: 100
            },
            xaxis: {
                show: false
            }
        });

        function update() {
            plot.setData([getRandomData()]);
            // Since the axes don't change, we don't need to call plot.setupGrid()
            plot.draw();
            setTimeout(update, updateInterval);
        }
        update();
    };
    // function to initiate Sparkline
    var runSparkline = function () {
        $(".sparkline_line_good span").sparkline("html", {
            type: "line",
            fillColor: "#B1FFA9",
            lineColor: "#459D1C",
            width: "50",
            height: "24"
        });
        $(".sparkline_line_bad span").sparkline("html", {
            type: "line",
            fillColor: "#FFC4C7",
            lineColor: "#BA1E20",
            width: "50",
            height: "24"
        });
        $(".sparkline_line_neutral span").sparkline("html", {
            type: "line",
            fillColor: "#CCCCCC",
            lineColor: "#757575",
            width: "50",
            height: "24"
        });
        $(".sparkline_bar_good span").sparkline('html', {
            type: "bar",
            barColor: "#459D1C",
            barWidth: "5",
            height: "24"
        });
        $(".sparkline_bar_bad span").sparkline('html', {
            type: "bar",
            barColor: "#BA1E20",
            barWidth: "5",
            height: "24"
        });
        $(".sparkline_bar_neutral span").sparkline('html', {
            type: "bar",
            barColor: "#757575",
            barWidth: "5",
            height: "24"
        });
    };
    // function to initiate EasyPieChart
    var runEasyPieChart = function () {
        if (isIE8 || isIE9) {
            if (!Function.prototype.bind) {
                Function.prototype.bind = function (oThis) {
                    if (typeof this !== "function") {
                        // closest thing possible to the ECMAScript 5 internal IsCallable function
                        throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
                    }
                    var aArgs = Array.prototype.slice.call(arguments, 1),
                            fToBind = this,
                            fNOP = function () {}, fBound = function () {
                        return fToBind.apply(this instanceof fNOP && oThis ? this : oThis, aArgs.concat(Array.prototype.slice.call(arguments)));
                    };
                    fNOP.prototype = this.prototype;
                    fBound.prototype = new fNOP();
                    return fBound;
                };
            }
        }
        $('.easy-pie-chart .bounce').easyPieChart({
            animate: 1000,
            size: 70
        });
        $('.easy-pie-chart .cpu').easyPieChart({
            animate: 1000,
            lineWidth: 3,
            barColor: '#35aa47',
            size: 70

        });
    };
    // function to initiate Full Calendar
    var runFullCalendar = function () {
        //calendar
        /* initialize the calendar
         -----------------------------------------------------------------*/
        var $modal = $('#event-management');
        $('#event-categories div.event-category').each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 50 //  original position after the drag
            });
        });
        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var calendar = $('#calendar').fullCalendar({
            buttonText: {
                prev: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [{
                    title: 'Meeting with Boss',
                    start: new Date(y, m, 1),
                    className: 'label-default'
                }, {
                    title: 'Bootstrap Seminar',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    className: 'label-teal'
                }, {
                    title: 'Lunch with Nicole',
                    start: new Date(y, m, d - 3, 12, 0),
                    className: 'label-green',
                    allDay: false
                }],
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                var $categoryClass = $(this).attr('data-class');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                if ($categoryClass)
                    copiedEventObject['className'] = [$categoryClass];
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                $modal.modal({
                    backdrop: 'static'
                });
                form = $("<form></form>");
                form.append("<div class='row'></div>");
                form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>New Event Name</label><input class='form-control' placeholder='Insert Event Name' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default'>Work</option>").append("<option value='label-green'>Home</option>").append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
                $modal.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                    form.submit();
                });
                $modal.find('form').on('submit', function () {
                    title = form.find("input[name='title']").val();
                    $categoryClass = form.find("select[name='category'] option:checked").val();
                    if (title !== null) {
                        calendar.fullCalendar('renderEvent', {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay,
                            className: $categoryClass
                        }, true // make the event "stick"
                                );
                    }
                    $modal.modal('hide');
                    return false;
                });
                calendar.fullCalendar('unselect');
            },
            eventClick: function (calEvent, jsEvent, view) {
                var form = $("<form></form>");
                form.append("<label>Change event name</label>");
                form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success'><i class='fa fa-check'></i> Save</button></span></div>");
                $modal.modal({
                    backdrop: 'static'
                });
                $modal.find('.remove-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.remove-event').unbind('click').click(function () {
                    calendar.fullCalendar('removeEvents', function (ev) {
                        return (ev._id == calEvent._id);
                    });
                    $modal.modal('hide');
                });
                $modal.find('form').on('submit', function () {
                    calEvent.title = form.find("input[type=text]").val();
                    calendar.fullCalendar('updateEvent', calEvent);
                    $modal.modal('hide');
                    return false;
                });
            }
        });
    };
    return {
        init: function () {
            runChartOmzetByQty();
            runChartOmzetByPerItem();
//            runChart1();
            runChartProdukTerlaris();
//            runChart3();
//            runSparkline();
//            runEasyPieChart();
//            runFullCalendar();
        }
    };
}();