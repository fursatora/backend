<form action="" method="POST">
   <div class="form-name">
          <input name="fio" type="text" placeholder="FirstName LastName" id="fio">
          <label for="fio" class="form-label">Ваше имя</label>
        </div>
  <div class="form-email">
          <input name="email" type="email" placeholder="name@example.com" id="email">
          <label for="email" class="form-label">Ваш email</label>
        </div>

<div class="year">
          <label for="year" class="form-label">Год рождения</label>
          <select name="year" id="year">
            <?php 
                for ($i = 1922; $i <= 2022; $i++) {
                printf('<option value="%d">%d год</option>', $i, $i);
                }
            ?>
          </select>
        </div>
  
  <input type="submit" value="ok" />
</form>
