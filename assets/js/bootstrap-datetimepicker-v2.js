(function(c) {
    var b = 0,
        a = function(f, h) {
            var r = {
                    pickDate: true,
                    pickTime: true,
                    startDate: moment({
                        y: 1970
                    }),
                    endDate: moment().add(50, "y"),
                    collapse: true,
                    language: "en",
                    defaultDate: "",
                    disabledDates: []
                },
                p = this,
                D = function() {
                    var L = false,
                        K, M;
                    p.options = c.extend({}, r, h);
                    if (!(p.options.pickTime || p.options.pickDate)) {
                        throw new Error("Must choose at least one picker")
                    }
                    p.id = b++;
                    moment.lang(p.options.language);
                    p.date = moment();
                    p.element = c(f);
                    p.unset = false;
                    p.isInput = p.element.is("input");
                    p.component = false;
                    if (p.element.hasClass("input-group")) {
                        p.component = p.element.find(".input-group-addon")
                    }
                    p.format = p.options.format;
                    if (!p.format) {
                        if (p.isInput) {
                            p.format = p.element.data("format")
                        } else {
                            p.format = p.element.find("input").data("format")
                        }
                        if (!p.format) {
                            p.format = (p.options.pickDate ? "L" : "")
                        }
                        p.format += (p.options.pickTime ? " LT" : "")
                    }
                    if (p.component) {
                        L = p.component.find("span")
                    }
                    if (p.options.pickTime) {
                        if (L && L.length) {
                            p.timeIcon = L.data("time-icon");
                            p.upIcon = L.data("up-icon");
                            p.downIcon = L.data("down-icon")
                        }
                        if (!p.timeIcon) {
                            p.timeIcon = "glyphicon glyphicon-time"
                        }
                        if (!p.upIcon) {
                            p.upIcon = "glyphicon glyphicon-chevron-up"
                        }
                        if (!p.downIcon) {
                            p.downIcon = "glyphicon glyphicon-chevron-down"
                        }
                        if (L) {
                            L.addClass(p.timeIcon)
                        }
                    }
                    if (p.options.pickDate) {
                        if (L && L.length) {
                            p.dateIcon = L.data("date-icon")
                        }
                        if (!p.dateIcon) {
                            p.dateIcon = "glyphicon glyphicon-calendar"
                        }
                        if (L) {
                            L.removeClass(p.timeIcon);
                            L.addClass(p.dateIcon)
                        }
                    }
                    p.widget = c(H(p.timeIcon, p.upIcon, p.downIcon, p.options.pickDate, p.options.pickTime, p.options.collapse)).appendTo("body");
                    p.minViewMode = p.options.minViewMode || p.element.data("date-minviewmode") || 0;
                    if (typeof p.minViewMode === "string") {
                        switch (p.minViewMode) {
                            case "months":
                                p.minViewMode = 1;
                                break;
                            case "years":
                                p.minViewMode = 2;
                                break;
                            default:
                                p.minViewMode = 0;
                                break
                        }
                    }
                    p.viewMode = p.options.viewMode || p.element.data("date-viewmode") || 0;
                    if (typeof p.viewMode === "string") {
                        switch (p.viewMode) {
                            case "months":
                                p.viewMode = 1;
                                break;
                            case "years":
                                p.viewMode = 2;
                                break;
                            default:
                                p.viewMode = 0;
                                break
                        }
                    }
                    for (K in p.options.disabledDates) {
                        M = p.options.disabledDates[K];
                        M = moment(M);
                        if (!M.isValid) {
                            M = moment(startDate).subtract(1, "day").format("L")
                        }
                        p.options.disabledDates[K] = M.format("L")
                    }
                    p.startViewMode = p.viewMode;
                    p.setStartDate(p.options.startDate || p.element.data("date-startdate"));
                    p.setEndDate(p.options.endDate || p.element.data("date-enddate"));
                    G();
                    J();
                    k();
                    B();
                    m();
                    e();
                    I();
                    if (p.options.defaultDate !== "") {
                        p.setValue(p.options.defaultDate)
                    }
                },
                n = function() {
                    var K = "absolute",
                        M = p.component ? p.component.offset() : p.element.offset(),
                        L = c(window);
                    p.width = p.component ? p.component.outerWidth() : p.element.outerWidth();
                    M.top = M.top + p.element.outerHeight();
                    if (p.options.width !== undefined) {
                        p.widget.width(p.options.width)
                    }
                    if (p.options.orientation === "left") {
                        p.widget.addClass("left-oriented");
                        M.left = M.left - p.widget.width() + 20
                    }
                    if (z()) {
                        K = "fixed";
                        M.top -= L.scrollTop();
                        M.left -= L.scrollLeft()
                    }
                    if (L.width() < M.left + p.widget.outerWidth()) {
                        M.right = L.width() - M.left - p.width;
                        M.left = "auto";
                        p.widget.addClass("pull-right")
                    } else {
                        M.right = "auto";
                        p.widget.removeClass("pull-right")
                    }
                    p.widget.css({
                        position: K,
                        top: M.top,
                        left: M.left,
                        right: M.right
                    })
                },
                y = function() {
                    p.element.trigger({
                        type: "change.dp",
                        date: p.getDate()
                    })
                },
                v = function(K) {
                    p.element.trigger({
                        type: "error.dp",
                        date: K
                    })
                },
                m = function(K) {
                    moment.lang(p.options.language);
                    var L = K;
                    if (!L) {
                        if (p.isInput) {
                            L = p.element.val()
                        } else {
                            L = p.element.find("input").val()
                        }
                        if (L) {
                            p.date = moment(L, p.format)
                        }
                        if (!p.date) {
                            p.date = moment()
                        }
                    }
                    p.viewDate = moment(p.date).startOf("month");
                    g();
                    x()
                },
                G = function() {
                    moment.lang(p.options.language);
                    var L = moment().weekday(0).weekday(),
                        M = c("<tr>"),
                        K = moment.weekdaysMin();
                    while (L < moment().weekday(0).weekday() + 7) {
                        M.append('<th class="dow">' + K[(L++) % 7] + "</th>")
                    }
                    p.widget.find(".datepicker-days thead").append(M)
                },
                J = function() {
                    moment.lang(p.options.language);
                    var L = "",
                        K = 0,
                        M = moment.monthsShort();
                    while (K < 12) {
                        L += '<span class="month">' + M[K++] + "</span>"
                    }
                    p.widget.find(".datepicker-months td").append(L)
                },
                g = function() {
                    moment.lang(p.options.language);
                    var V = p.viewDate.year(),
                        T = p.viewDate.month(),
                        U = p.options.startDate.year(),
                        X = p.options.startDate.month(),
                        Y = p.options.endDate.year(),
                        R = p.options.endDate.month(),
                        N, Q, P = [],
                        Z, M, O, W, L, S, K = moment.months();
                    p.widget.find(".datepicker-days").find(".disabled").removeClass("disabled");
                    p.widget.find(".datepicker-months").find(".disabled").removeClass("disabled");
                    p.widget.find(".datepicker-years").find(".disabled").removeClass("disabled");
                    p.widget.find(".datepicker-days th:eq(1)").text(K[T] + " " + V);
                    N = moment(p.viewDate).subtract("months", 1);
                    W = N.daysInMonth();
                    N.date(W).startOf("week");
                    if ((V == U && T <= X) || V < U) {
                        p.widget.find(".datepicker-days th:eq(0)").addClass("disabled")
                    }
                    if ((V == Y && T >= R) || V > Y) {
                        p.widget.find(".datepicker-days th:eq(2)").addClass("disabled")
                    }
                    Q = moment(N).add(42, "d");
                    while (N.isBefore(Q)) {
                        if (N.weekday() === moment().startOf("week").weekday()) {
                            Z = c("<tr>");
                            P.push(Z)
                        }
                        M = "";
                        if (N.year() < V || (N.year() == V && N.month() < T)) {
                            M += " old"
                        } else {
                            if (N.year() > V || (N.year() == V && N.month() > T)) {
                                M += " new"
                            }
                        }
                        if (N === p.viewDate) {
                            M += " active"
                        }
                        if ((moment(N).add(1, "d") <= p.options.startDate) || (N > p.options.endDate) || d(N)) {
                            M += " disabled"
                        }
                        Z.append('<td class="day' + M + '">' + N.date() + "</td>");
                        N.add(1, "d")
                    }
                    p.widget.find(".datepicker-days tbody").empty().append(P);
                    S = moment().year(), K = p.widget.find(".datepicker-months").find("th:eq(1)").text(V).end().find("span").removeClass("active");
                    if (S === V) {
                        K.eq(moment().month()).addClass("active")
                    }
                    if (S - 1 < U) {
                        p.widget.find(".datepicker-months th:eq(0)").addClass("disabled")
                    }
                    if (S + 1 > Y) {
                        p.widget.find(".datepicker-months th:eq(2)").addClass("disabled")
                    }
                    for (O = 0; O < 12; O++) {
                        if ((V == U && X > O) || (V < U)) {
                            c(K[O]).addClass("disabled")
                        } else {
                            if ((V == Y && R < O) || (V > Y)) {
                                c(K[O]).addClass("disabled")
                            }
                        }
                    }
                    P = "";
                    V = parseInt(V / 10, 10) * 10;
                    L = p.widget.find(".datepicker-years").find("th:eq(1)").text(V + "-" + (V + 9)).end().find("td");
                    p.widget.find(".datepicker-years").find("th").removeClass("disabled");
                    if (U > V) {
                        p.widget.find(".datepicker-years").find("th:eq(0)").addClass("disabled")
                    }
                    if (Y < V + 9) {
                        p.widget.find(".datepicker-years").find("th:eq(2)").addClass("disabled")
                    }
                    V -= 1;
                    for (O = -1; O < 11; O++) {
                        P += '<span class="year' + (O === -1 || O === 10 ? " old" : "") + (S === V ? " active" : "") + ((V < U || V > Y) ? " disabled" : "") + '">' + V + "</span>";
                        V += 1
                    }
                    L.html(P)
                },
                k = function() {
                    var N = p.widget.find(".timepicker .timepicker-hours table"),
                        M = "",
                        O, L, K;
                    N.parent().hide();
                    O = 0;
                    for (L = 0; L < 6; L += 1) {
                        M += "<tr>";
                        for (K = 0; K < 4; K += 1) {
                            M += '<td class="hour">' + C(O.toString()) + "</td>";
                            O++
                        }
                        M += "</tr>"
                    }
                    N.html(M)
                },
                B = function() {
                    var N = p.widget.find(".timepicker .timepicker-minutes table"),
                        M = "",
                        O = 0,
                        L, K;
                    N.parent().hide();
                    for (L = 0; L < 5; L++) {
                        M += "<tr>";
                        for (K = 0; K < 4; K += 1) {
                            M += '<td class="minute">' + C(O.toString()) + "</td>";
                            O += 3
                        }
                        M += "</tr>"
                    }
                    N.html(M)
                },
                x = function() {
                    if (!p.date) {
                        return
                    }
                    var M = p.widget.find(".timepicker span[data-time-component]"),
                        K = p.date.hours(),
                        L = "AM";
                    if (K >= 12) {
                        L = "PM"
                    }
                    if (K === 0) {
                        K = 12
                    } else {
                        if (K != 12) {
                            K = K % 12
                        }
                    }
                    p.widget.find(".timepicker [data-action=togglePeriod]").text(L);
                    M.filter("[data-time-component=hours]").text(C(K));
                    M.filter("[data-time-component=minutes]").text(C(p.date.minutes()))
                },
                A = function(P) {
                    P.stopPropagation();
                    P.preventDefault();
                    p.unset = false;
                    var O = c(P.target).closest("span, td, th"),
                        N, L, M, K;
                    if (O.length === 1) {
                        if (!O.is(".disabled")) {
                            switch (O[0].nodeName.toLowerCase()) {
                                case "th":
                                    switch (O[0].className) {
                                        case "switch":
                                            e(1);
                                            break;
                                        case "prev":
                                        case "next":
                                            M = F.modes[p.viewMode].navStep;
                                            if (O[0].className === "prev") {
                                                M = M * -1
                                            }
                                            p.viewDate.add(M, F.modes[p.viewMode].navFnc);
                                            g();
                                            break
                                    }
                                    break;
                                case "span":
                                    if (O.is(".month")) {
                                        N = O.parent().find("span").index(O);
                                        p.viewDate.month(N)
                                    } else {
                                        L = parseInt(O.text(), 10) || 0;
                                        p.viewDate.year(L)
                                    }
                                    if (p.viewMode !== 0) {
                                        p.date = moment({
                                            y: p.viewDate.year(),
                                            M: p.viewDate.month(),
                                            d: p.viewDate.date(),
                                            h: p.date.hours(),
                                            m: p.date.minutes()
                                        });
                                        y()
                                    }
                                    e(-1);
                                    g();
                                    break;
                                case "td":
                                    if (O.is(".day")) {
                                        K = parseInt(O.text(), 10) || 1;
                                        N = p.viewDate.month();
                                        L = p.viewDate.year();
                                        if (O.is(".old")) {
                                            if (N === 0) {
                                                N = 11;
                                                L -= 1
                                            } else {
                                                N -= 1
                                            }
                                        } else {
                                            if (O.is(".new")) {
                                                if (N == 11) {
                                                    N = 0;
                                                    L += 1
                                                } else {
                                                    N += 1
                                                }
                                            }
                                        }
                                        p.date = moment({
                                            y: L,
                                            M: N,
                                            d: K,
                                            h: p.date.hours(),
                                            m: p.date.minutes()
                                        });
                                        p.viewDate = moment({
                                            y: L,
                                            M: N,
                                            d: Math.min(28, K)
                                        });
                                        g();
                                        w();
                                        y()
                                    }
                                    break
                            }
                        }
                    }
                },
                q = {
                    incrementHours: function() {
                        i("add", "hours")
                    },
                    incrementMinutes: function() {
                        i("add", "minutes")
                    },
                    decrementHours: function() {
                        i("subtract", "hours")
                    },
                    decrementMinutes: function() {
                        i("subtract", "minutes")
                    },
                    togglePeriod: function() {
                        var K = p.date.hours();
                        if (K >= 12) {
                            K -= 12
                        } else {
                            K += 12
                        }
                        p.date.hours(K)
                    },
                    showPicker: function() {
                        p.widget.find(".timepicker > div:not(.timepicker-picker)").hide();
                        p.widget.find(".timepicker .timepicker-picker").show()
                    },
                    showHours: function() {
                        p.widget.find(".timepicker .timepicker-picker").hide();
                        p.widget.find(".timepicker .timepicker-hours").show()
                    },
                    showMinutes: function() {
                        p.widget.find(".timepicker .timepicker-picker").hide();
                        p.widget.find(".timepicker .timepicker-minutes").show()
                    },
                    selectHour: function(K) {
                        p.date.hours(parseInt(c(K.target).text(), 10));
                        q.showPicker.call(p)
                    },
                    selectMinute: function(K) {
                        p.date.minutes(parseInt(c(K.target).text(), 10));
                        q.showPicker.call(p)
                    }
                },
                u = function(L) {
                    E(L);
                    if (!p.date) {
                        p.date = moment({
                            y: 1970
                        })
                    }
                    var K = c(L.currentTarget).data("action"),
                        M = q[K].apply(p, arguments);
                    w();
                    x();
                    y();
                    return M
                },
                E = function(K) {
                    K.stopPropagation();
                    K.preventDefault()
                },
                t = function(L) {
                    var K = c(L.target),
                        M = K.val();
                    if (p.date.isValid) {
                        m();
                        p.setValue(p.date.getTime());
                        y();
                        w()
                    } else {
                        if (M && M.trim()) {
                            p.setValue(p.date.getTime());
                            if (p.date.isValid) {
                                w()
                            } else {
                                K.val("");
                                v(M)
                            }
                        } else {
                            if (p.date.isValid) {
                                p.setValue(null);
                                y();
                                p.unset = true
                            }
                        }
                    }
                },
                e = function(K) {
                    if (K) {
                        p.viewMode = Math.max(p.minViewMode, Math.min(2, p.viewMode + K))
                    }
                    p.widget.find(".datepicker > div").hide().filter(".datepicker-" + F.modes[p.viewMode].clsName).show()
                },
                I = function() {
                    var M = this,
                        P, O, L, K, N;
                    p.widget.on("click", ".datepicker *", c.proxy(A, this));
                    p.widget.on("click", "[data-action]", c.proxy(u, this));
                    p.widget.on("mousedown", c.proxy(E, this));
                    if (p.options.pickDate && p.options.pickTime) {
                        p.widget.on("click.togglePicker", ".accordion-toggle", function(Q) {
                            Q.stopPropagation();
                            P = c(this);
                            O = P.closest("ul");
                            L = O.find(".in");
                            K = O.find(".collapse:not(.in)");
                            if (L && L.length) {
                                N = L.data("collapse");
                                if (N && N.transitioning) {
                                    return
                                }
                                L.collapse("hide");
                                K.collapse("show");
                                P.find("span").toggleClass(M.timeIcon + " " + M.dateIcon);
                                p.element.find(".input-group-addon span").toggleClass(M.timeIcon + " " + M.dateIcon)
                            }
                        })
                    }
                    if (p.isInput) {
                        p.element.on({
                            focus: c.proxy(p.show, this),
                            change: c.proxy(t, this),
                            blur: c.proxy(p.hide, this)
                        })
                    } else {
                        p.element.on({
                            change: c.proxy(t, this)
                        }, "input");
                        if (p.component) {
                            p.component.on("click", c.proxy(p.show, this))
                        } else {
                            p.element.on("click", c.proxy(p.show, this))
                        }
                    }
                },
                o = function() {
                    c(window).on("resize.datetimepicker" + p.id, c.proxy(n, this));
                    if (!p.isInput) {
                        c(document).on("mousedown.datetimepicker" + p.id, c.proxy(p.hide, this))
                    }
                },
                s = function() {
                    p.widget.off("click", ".datepicker *", p.click);
                    p.widget.off("click", "[data-action]");
                    p.widget.off("mousedown", p.stopEvent);
                    if (p.options.pickDate && p.options.pickTime) {
                        p.widget.off("click.togglePicker")
                    }
                    if (p.isInput) {
                        p.element.off({
                            focus: p.show,
                            change: p.change
                        })
                    } else {
                        p.element.off({
                            change: p.change
                        }, "input");
                        if (p.component) {
                            p.component.off("click", p.show)
                        } else {
                            p.element.off("click", p.show)
                        }
                    }
                },
                j = function() {
                    c(window).off("resize.datetimepicker" + p.id);
                    if (!p.isInput) {
                        c(document).off("mousedown.datetimepicker" + p.id)
                    }
                },
                z = function() {
                    if (p.element) {
                        var L = p.element.parents(),
                            K = false,
                            M;
                        for (M = 0; M < L.length; M++) {
                            if (c(L[M]).css("position") == "fixed") {
                                K = true;
                                break
                            }
                        }
                        return K
                    } else {
                        return false
                    }
                },
                w = function() {
                    moment.lang(p.options.language);
                    var L = "",
                        K;
                    if (!p.unset) {
                        L = moment(p.date).format(p.format)
                    }
                    if (!p.isInput) {
                        if (p.component) {
                            K = p.element.find("input");
                            K.val(L)
                        }
                        p.element.data("date", L)
                    } else {
                        p.element.val(L)
                    }
                    if (!p.options.pickTime) {
                        p.hide()
                    }
                },
                i = function(M, L) {
                    moment.lang(p.options.language);
                    var K;
                    if (M == "add") {
                        K = moment(p.date);
                        if (K.hours() == 23) {
                            K.add(1, L)
                        }
                        K.add(1, L)
                    } else {
                        K = moment(p.date).subtract(1, L)
                    }
                    if (K.isAfter(p.options.endDate) || K.subtract(1, L).isBefore(p.options.startDate) || d(K)) {
                        v(K.format(p.format));
                        return
                    }
                    if (M == "add") {
                        p.date.add(1, L)
                    } else {
                        p.date.subtract(1, L)
                    }
                },
                d = function(K) {
                    moment.lang(p.options.language);
                    var M = p.options.disabledDates,
                        L;
                    for (L in M) {
                        if (M[L] == moment(K).format("L")) {
                            return true
                        }
                    }
                    return false
                },
                C = function(K) {
                    K = K.toString();
                    if (K.length >= 2) {
                        return K
                    } else {
                        return "0" + K
                    }
                },
                H = function(N, P, M, L, K, O) {
                    if (L && K) {
                        return ('<div class="bootstrap-datetimepicker-widget dropdown-menu" style="z-index:9999 !important;"><ul class="list-unstyled"><li' + (O ? ' class="collapse in"' : "") + '><div class="datepicker">' + F.template + '</div></li><li class="picker-switch accordion-toggle"><a class="btn" style="width:100%"><span class="' + N + '"></span></a></li><li' + (O ? ' class="collapse"' : "") + '><div class="timepicker">' + l.getTemplate(P, M) + "</div></li></ul></div>")
                    } else {
                        if (K) {
                            return ('<div class="bootstrap-datetimepicker-widget dropdown-menu"><div class="timepicker">' + l.getTemplate(P, M) + "</div></div>")
                        } else {
                            return ('<div class="bootstrap-datetimepicker-widget dropdown-menu"><div class="datepicker">' + F.template + "</div></div>")
                        }
                    }
                },
                F = {
                    modes: [{
                        clsName: "days",
                        navFnc: "month",
                        navStep: 1
                    }, {
                        clsName: "months",
                        navFnc: "year",
                        navStep: 1
                    }, {
                        clsName: "years",
                        navFnc: "year",
                        navStep: 10
                    }],
                    headTemplate: '<thead><tr><th class="prev">&lsaquo;</th><th colspan="5" class="switch"></th><th class="next">&rsaquo;</th></tr></thead>',
                    contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>'
                },
                l = {
                    hourTemplate: '<span data-action="showHours" data-time-component="hours" class="timepicker-hour"></span>',
                    minuteTemplate: '<span data-action="showMinutes" data-time-component="minutes" class="timepicker-minute"></span>'
                };
            F.template = '<div class="datepicker-days"><table class="table-condensed">' + F.headTemplate + '<tbody></tbody></table></div><div class="datepicker-months"><table class="table-condensed">' + F.headTemplate + F.contTemplate + '</table></div><div class="datepicker-years"><table class="table-condensed">' + F.headTemplate + F.contTemplate + "</table></div>";
            l.getTemplate = function(L, K) {
                return ('<div class="timepicker-picker"><table class="table-condensed"><tr><td><a href="#" class="btn" data-action="incrementHours"><span class="' + L + '"></span></a></td><td class="separator"></td><td><a href="#" class="btn" data-action="incrementMinutes"><span class="' + L + '"></span></a></td><td class="separator"></td></tr><tr><td>' + l.hourTemplate + '</td> <td class="separator">:</td><td>' + l.minuteTemplate + '</td> <td class="separator"></td><td><button type="button" class="btn btn-primary" data-action="togglePeriod"></button></td></tr><tr><td><a href="#" class="btn" data-action="decrementHours"><span class="' + K + '"></span></a></td><td class="separator"></td><td><a href="#" class="btn" data-action="decrementMinutes"><span class="' + K + '"></span></a></td><td class="separator"></td></tr></table></div><div class="timepicker-hours" data-action="selectHour"><table class="table-condensed"></table></div><div class="timepicker-minutes" data-action="selectMinute"><table class="table-condensed"></table></div>')
            };
            p.destroy = function() {
                s();
                j();
                p.widget.remove();
                p.element.removeData("DateTimePicker");
                p.component.removeData("DateTimePicker")
            };
            p.show = function(K) {
                p.widget.show();
                p.height = p.component ? p.component.outerHeight() : p.element.outerHeight();
                n();
                p.element.trigger({
                    type: "show.dp",
                    date: p.date
                });
                o();
                if (K) {
                    E(K)
                }
            }, p.disable = function() {
                p.element.find("input").prop("disabled", true);
                s()
            }, p.enable = function() {
                p.element.find("input").prop("disabled", false);
                I()
            }, p.hide = function() {
                var M = p.widget.find(".collapse"),
                    K, L;
                for (K = 0; K < M.length; K++) {
                    L = M.eq(K).data("collapse");
                    if (L && L.transitioning) {
                        return
                    }
                }
                p.widget.hide();
                p.viewMode = p.startViewMode;
                e();
                p.element.trigger({
                    type: "hide.dp",
                    date: p.date
                });
                j()
            }, p.setValue = function(K) {
                moment.lang(p.options.language);
                if (!K) {
                    p.unset = true
                } else {
                    p.unset = false
                }
                var L = moment(K);
                if (!L.isValid()) {
                    throw new Error("Couldn't parase date or is invalid");
                    v(K.format(p.format))
                }
                p.date = L;
                w();
                p.viewDate = moment({
                    y: p.date.year(),
                    M: p.date.month()
                });
                g();
                x()
            }, p.getDate = function() {
                if (p.unset) {
                    return null
                }
                return p.date
            }, p.setDate = function(K) {
                if (!K) {
                    p.setValue(null)
                } else {
                    p.setValue(K)
                }
            }, p.setEndDate = function(K) {
                p.options.endDate = moment(K);
                if (!p.options.endDate.isValid) {
                    p.options.endDate = moment().add(50, "y")
                }
                if (p.viewDate) {
                    m()
                }
            }, p.setStartDate = function(K) {
                p.options.startDate = moment(K);
                if (!p.options.startDate.isValid) {
                    p.options.startDate = moment({
                        y: 1970
                    })
                }
                if (p.viewDate) {
                    m()
                }
            };
            D()
        };
    c.fn.datetimepicker = function(d) {
        return this.each(function() {
            var f = c(this),
                e = f.data("DateTimePicker");
            if (!e) {
                f.data("DateTimePicker", new a(this, d))
            }
        })
    }
})(jQuery);