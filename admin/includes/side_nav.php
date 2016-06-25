<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
<!--        <li class="active">-->
<!--            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>-->
<!--        </li>-->
<!--        <li>-->
<!--            <a href="index.php?p=users"><i class="fa fa-fw fa-bar-chart-o"></i> Users</a>-->
<!--        </li>-->
<!--        <li>-->
<!--            <a href="index.php?p=upload"><i class="fa fa-fw fa-table"></i> Upload</a>-->
<!--        </li>-->
<!--        <li>-->
<!--            <a href="index.php?p=photos"><i class="fa fa-fw fa-edit"></i> Photos</a>-->
<!--        </li>-->
<!--        <li>-->
<!--            <a href="index.php?p=comments"><i class="fa fa-fw fa-edit"></i> Comments</a>-->
<!--        </li>-->
        <?php
        // removing edit pages from menu

        foreach($site_pages AS $key => $value) {
            if($value == 'edit_image') {
                unset($site_pages[$key]);
            }
        }

        ?>

        <?php foreach($site_pages as $page){ ?>
            <li
                <?php
                if(isset($_GET['p'])) {
                    if ($page == $_GET['p']) {
                        echo 'class="active"';
                    }
                }
                ?>
            >
                <a href="index.php?p=<?php echo $page; ?>">
                    <i class="fa fa-fw fa-table"></i> <?php echo ucfirst($page); ?>
                </a>
            </li>
        <?php } ?>
        <?php
        // adding it back
        $site_pages[] = 'edit_image'; ?>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="#">Dropdown Item</a>
                </li>
                <li>
                    <a href="#">Dropdown Item</a>
                </li>
            </ul>
        </li>

    </ul>
</div>
<!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">