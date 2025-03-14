<?php
include(__DIR__ . "/../../header.php");

?>
<br />
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <input type="text" id="search" class="form-control" placeholder="Type to search..." aria-label="Search">

            </div>
            <div class="col">
                <a name="" id="" class="btn btn-primary" href="/user/displayCreate" role="button">Create User</a>
            </div>
        </div>
    </div>
    <div class=" card-body">

        <div class="table-responsive-sm">
            <table id="user-table" class="table">
                <thead>
                    <tr>
                        <th scope="col" class="sortable" data-sort="id">Id <i class="fa-solid fa-sort"></i></th>
                        <th scope="col" class="sortable" data-sort="username">Username <i class="fa-solid fa-sort"></i></th>
                        <th scope="col" class="sortable" data-sort="username">Password</th>
                        <th scope="col" class="sortable" data-sort="email">Email <i class="fa-solid fa-sort"></i></th>
                        <th scope="col" class="sortable" data-sort="role">Role <i class="fa-solid fa-sort"></i></th>
                        <th scope="col" class="sortable" data-sort="creation_date">Registration Date <i class="fa-solid fa-sort"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($model as $user) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $user->getId(); ?></td>
                            <td><?php echo $user->getUsername(); ?></td>
                            <td>********</td>
                            <td><?php echo $user->getEmail(); ?></td>
                            <td><?php echo $user->getRole();  ?></td>
                            <td><?php echo DateTime::createFromFormat('Y-m-d H:i:s', $user->getCreationDate())->format('d-m-Y'); ?></td>
                            <td>
                                <input name="editbtn" id="editbtn" class="btn btn-info" type="button" value="Edit" onclick="location='/user/edit?userId=<?php echo $user->getId(); ?>'">
                                <input name="deletebtn" id="deletebtn" class="btn btn-danger" type="button" value="Delete" onclick="location='/user/delete?userId=<?php echo $user->getId(); ?>'">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<script>
    $(function() {
        $('.sortable').on('click', function() {
            var $table = $(this).closest('table');
            var index = $(this).index();
            var rows = $table.find('tbody > tr').toArray().sort(compareCells(index));
            var order = $(this).hasClass('asc') ? -1 : 1;
            if (order === 1) {
                $(this).removeClass('desc').addClass('asc');
            } else {
                $(this).removeClass('asc').addClass('desc');
                rows = rows.reverse();
            }
            for (var i = 0; i < rows.length; i++) {
                $table.children('tbody').append(rows[i]);
            }
        });

        function compareCells(index) {
            return function(a, b) {
                var valA = getCellValue(a, index);
                var valB = getCellValue(b, index);
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
            };
        }

        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text();
        }
    });

    $(function() {
        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>


<?php include(__DIR__ . "/../../footer.php"); ?>