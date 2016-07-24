</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="styles/js/jquery.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work',     11],
            ['Eat',      2],
            ['Commute',  2],
            ['Watch TV', 2],
            ['Sleep',    7]
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

<!-- Bootstrap Core JavaScript -->
<script src="styles/js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="styles/js/plugins/morris/raphael.min.js"></script>
<script src="styles/js/plugins/morris/morris.min.js"></script>
<script src="styles/js/plugins/morris/morris-data.js"></script>



</body>

</html>
