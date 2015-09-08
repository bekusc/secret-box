<?php if (count($validate->errors())) : ?>   
    <div class="errors">
        <ul>
            <?php
                foreach ($validate->errors() as $error) {
                	echo "<li>{$error}</li>";
                }
            ?>
        </ul>
    </div>
<?php endif; ?>