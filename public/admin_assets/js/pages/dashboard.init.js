// new Chartist.Line(
//     "#chart-with-area",
//     { labels: [1, 2, 3, 4, 5, 6, 7, 8], series: [[5, 9, 7, 8, 5, 3, 5, 4]] },
//     { low: 0, showArea: !0, plugins: [Chartist.plugins.tooltip()] }
// );
var chart = new Chartist.Pie(
    "#ct-donut",
    { series: [54, 28, 17], labels: [1, 2, 3] },
    { donut: !0, showLabel: !1, plugins: [Chartist.plugins.tooltip()] }
);
$(".peity-donut").each(function() {
    $(this).peity("donut", $(this).data());
}),
    $(".peity-line").each(function() {
        $(this).peity("line", $(this).data());
    });
