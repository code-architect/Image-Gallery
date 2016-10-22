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
            ['No. of Comments', <?php echo $app->comment->count_all(); ?>],
            ['No. of Users',  <?php echo $app->user->count_all(); ?>],
            ['No. of Images', <?php echo $app->photo->count_all(); ?>],
            ['Sleep',    7]
        ]);

        var options = {
            legend:'none',
            pieSliceText:'label',
            backgroundColor: 'transparent',
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
