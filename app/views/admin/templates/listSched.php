<?php if($data['listSchedule']) : ?>
    <?php foreach($data['listSchedule'] AS $schedule) : ?>
    <tr class="driverRouteCheck" data-id="<?=$schedule->id;?>">
        <td>
            <span><?=$schedule->busNum;?></span>
        </td>
        <td>
            <span><?=$schedule->driver;?></span>
        </td>
        <td>
            <span><?=$schedule->Time;?></span>
        </td>
        <td>
            <span><?=$schedule->routeName;?></span>
        </td>
        <td>
            <button>Delete</button>
            <button>Update</button>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endif;?>