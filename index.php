<?php
$tatus = 'null';

$sort = '1';
  include_once 'functions.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['Clist'])) {
      if (!empty($_POST['Clist'])) {
        createList($_POST['Clist']);
      }
    }
    if (isset($_POST['deleteList'])) {
      if (!empty($_POST['deleteList'])) {
        deleteList($_POST['deleteList']);
      }
    }
    if (isset($_POST['home'])) {
      Header('Location: index.php');
    }
    if (isset($_POST['taskName']) && isset($_POST['addTask'])) {
      if (!empty($_POST['taskName']) && !empty($_POST['addTask'])) {
        addTask($_POST['addTask'],$_POST['taskName']);
      }
    }
    if (isset($_POST['deleteTask'])) {
      if (!empty($_POST['deleteTask'])) {
        deleteTask($_POST['deleteTask']);
      }
    }
    if (isset($_POST['savelist'])  && isset($_POST['Taskname']) ) {
      if (!empty($_POST['savelist']) && !empty($_POST['Taskname'])) {
        saveListName($_POST['savelist'],$_POST['Taskname']);
      }
    }
    if (isset($_POST['save']) && isset($_POST['textarea'])) {
      if (!empty($_POST['textarea'])) {
        saveTask($_POST['save'], $_POST['textarea'],$_POST['duur'],$_POST['status']);
      }
  }

  if (isset($_POST['sort'])) {
      $tatus = 'null';
      $sort = $_POST['sort'];
      if ($sort == '1') {
        $sort = '2';
      }else {
        $sort = '1';
      }


  }
  if (isset($_POST['tatus'])) {
    $tatus = $_POST['tatus'];
  }
  if (isset($_POST['status_sort'])) {
      $tatus = $_POST['status_sort'];
  }
}
    $lists = getLists();

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"href="style.css">
  </head>
  <body>
    <div class="container">
      <h1>To do list</h1>
      <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">

              <div class="card rounded-3">
                <div class="card-body p-4">

                  <h4 class="text-center my-3 pb-3">To Do App</h4>

                  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                    <div class="col-12">
                      <div class="form-outline">
                          <input type="text" name="Clist" class="form-control"/>
                          <label class="form-label" for="form1">Enter new list here</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-warning">Get tasks</button>
                    </div>
                  </form>
                </div>
                <?php foreach ($lists as $key): ?>
                <?php $tasks = getTask($key['lijst_id'],$sort,$tatus); ?>
                <div class="onlist">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button class="btn btn-danger" style="float:right;"type="submit" value="<?php echo $key['lijst_id']; ?>" name="deleteList">X</button>
                  </form>
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="text" name="Taskname" class="col-12 inputname" placeholder="Task name" value="<?php echo $key['naam']; ?>">
                    <button type="submit" class="fl-r btn btn-primary col-12" name="savelist" value="<?php echo $key['lijst_id']; ?>">Save</button>
                  </form>
                  <div class="row">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <div class="col-6">
                        <input class="col-12" placeholder="Add task"type="text" name="taskName">
                      </div>
                      <div class="col-6">
                        <button class="col-12 btn btn-primary" type="submit" name="addTask" value="<?php echo $key['lijst_id']; ?>">Add</button>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                          <button type="submit" name="sort" value="<?php echo $sort; ?>">Sort duur</button>
                          <input style="visibility: hidden;" type="text"  name="tatus" value="<?php
                              echo $tatus; ?>">
                        </form>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                          <button type="submit" name="home">return</button>
                        </form>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <select name="status_sort">
                            <option value="1">Klaar</option>
                            <option value="2">Bijna Klaar</option>
                            <option value="3">Moet nog beginnen</option>
                          </select>
                          <button type="submit" name="button">Sort</button>
                        </form>
                      </div>
                    </form>
                  </div>
                   <table class="table mb-4">
                     <thead>
                       <tr>
                         <th scope="col">No.</th>
                         <th scope="col">Todo item </th>
                         <th scope="col">Status</th>
                         <th scope="col">Actions</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php foreach ($tasks as $key): ?>
                       <tr>
                         <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                           <th scope="row">*</th>
                           <td><textarea type="text" name="textarea" class="col-12 h" value="<?php echo $key['taak']; ?>"><?php echo $key['taak']; ?></textarea></td>
                           <td>
                           <select name="status">
                             <option selected value="<?php echo $key['status']; ?>"><?php if ($key['status'] == '1'){ echo 'klaar';} elseif ($key['status'] == '2') { echo "bijna klaar"; } elseif($key['status'] == '3') { echo "Moet nog beginnen";   } else {
                             echo '-' ;
                           }?>
                            </option>
                             <option value="1">Klaar</option>
                             <option value="2">Bijna klaar</option>
                             <option value="3">Moet nog beginnen</option>
                           </select>
                           <select name="duur">
                             <option selected value="<?php echo $key['duur']; ?>"><?php echo $key['duur']; ?> Minuten</option>
                             <option value="15">15 Minuten</option>
                             <option value="20">20 Minuten</option>
                             <option value="30">30 Minuten</option>
                             <option value="40">40 Minuten</option>
                             <option value="50">50 Minuten</option>
                             <option value="60">60 Minuten</option>
                           </select>
                         </td>
                           <td>
                             <button type="submit" name="save" value="<?php echo $key['taak_id']; ?>" class="btn btn-success ms-1">Save</button>
                             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                               <button type="submit" class="btn btn-danger" name="deleteTask" value="<?php echo $key['taak_id']; ?>">Delete</button>
                             </form>
                           </td>
                          </form>
                       </tr>
                       <?php endforeach; ?>
                     </tbody>
                   </table>
                </div>
                 <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>
