<form action="" method="POST">
  <div class="form-floating mb-3">
          <input class="form-control" name="fio" type="text" placeholder="FirstName LastName" id="fio">
          <label for="fio" class="form-label">Ваше имя</label>
        </div>

  <div class="form-floating mb-3">
          <input class="form-control" name="email" type="email" placeholder="name@example.com" id="email">
          <label for="email" class="form-label">Ваш email</label>
        </div>
   
  <div class="mb-3">
          <label for="year" class="form-label">Дата рождения</label>
          <select class="form-select" name="year" id="year">
            <?php 
               for($i = 1900; $i < 2020; $i++){
                printf('<option value="%d">%d год</option>', $i, $i);
                }
             ?>
          </select>
        </div>

   <div class="mb-3">
          <label class="form-label">Пол</label>
          <br>
          <input class="form-check-input" type="radio" name="sex" id="sex1" value="0" checked> Male
          <input class="form-check-input" type="radio" name="sex" id="sex2" value="1"> Female
        </div>
   
   <div class="mb-3">
          <label class="form-label">Число конечностей</label>
          <input class="form-check-input" type="radio" name="limb" id="limb1" value="2" checked>
            <label class="form-check-label">2</label>
          <input class="form-check-input" type="radio" name="limb" id="limb2" value="4">
            <label class="form-check-label">4</label>
          <input class="form-check-input" type="radio" name="limb" id="limb3" value="6">
            <label class="form-check-label">6</label>
          <input class="form-check-input" type="radio" name="limb" id="limb4" value="8">
            <label class="form-check-label">8</label>
          <input class="form-check-input" type="radio" name="limb" id="limb5" value="10">
            <label class="form-check-label">10</label>
        </div>
   
  <div class="mb-3">
          <label class="form-label">Сверхсособности</label>
          <select class="form-select" name="abilities[]" multiple="multiple">
            <option value="immort">Бессмертие</option>
            <option value="wall">Прохождение сковзь стены</option>
            <option value="levit">Левитация</option>
            <option value="invis">Невидимость</option>
          </select>
        </div>
   
   <div class="mb-3 form-floating">
          <textarea class="form-control" name="text" placeholder="Биография" style="height: 100px; width: 420px;"></textarea>
          <label class="form-label">Биография</label>
        </div>
   
    <div class="mb-3 form-check">
          <input class="form-check-input" type="checkbox" name="accept" value="1">
          <label class="form-check-label">Принять пользовательские соглашения</label>
        </div>
   
   <div class="d-grid gap-2 col-6 mx-auto">
          <button class="btn btn-light" type="submit" value="send">Отправить</button>
        </div>

</form>
