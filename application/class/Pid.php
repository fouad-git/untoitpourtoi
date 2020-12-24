<?php

namespace App;


use \PDO;

class Pid
{  
  /**
   * req
   *
   * @var mixed
   */
  private $req;  
  /**
   * dbh
   *
   * @var mixed
   */
  private $dbh;  
  /**
   * lastid
   *
   * @var mixed
   */
  private $lastid;  
  /**
   * result
   *
   * @var mixed
   */
  public  $result;  
  /**
   * typepid
   *
   * @var mixed
   */
  private $typepid;  
  /**
   * payspid
   *
   * @var mixed
   */
  private $payspid;  
  /**
   * datedelivrance
   *
   * @var mixed
   */
  private $datedelivrance;  
  /**
   * dateexpiration
   *
   * @var mixed
   */
  private $dateexpiration;  
  /**
   * phpFileUploadErrors
   *
   * @var mixed
   */
  private $phpFileUploadErrors;  
  /**
   * file_array
   *
   * @var mixed
   */
  private $file_array;
  
  /**
   * ajoutsPid
   *
   * @return void
   */
  public function ajoutsPid()
  {
    $this->phpFileUploadErrors = array(
      0 => 'There is no error, the file uploaded with success',
      1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
      2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
      3 => 'The uploaded file was only partially uploaded',
      4 => 'No file was uploaded',
      6 => 'Missing a temporary folder',
      7 => 'Failed to write file to disk',
      8 => 'A PHP extension stopped the file upload.'
    );
    if (isset($_POST['pid']) && isset($_FILES['piddocument'])) {
      $this->file_array = $this->reArrayFiles($_FILES['piddocument']);
      $this->typepid = $_POST['pidType'];
      $this->payspid = $_POST['pidPays'];
      $this->datedelivrance = $_POST['datedelivrance'];
      $this->dateexpiration = $_POST['dateexpiration'];
      $this->lastid = $_SESSION['lastid'];

      for ($i = 0; $i < count($this->file_array); $i++) {
        if ($this->file_array[$i]['error']) {
?><div class="alert alert-success">
            <?php echo $this->file_array[$i]['name'] . ' - ' . $this->phpFileUploadErrors[$this->file_array[$i]['error']];
            ?> </div> <?php
                    } else {
                      $extensions = array('jpg', 'png', 'gif', 'jpeg');
                      $file_ext = explode('.', $this->file_array[$i]['name']);
                      $name = $file_ext[0];
                      $name = preg_replace("!-!", " ", $name);
                      $name = ucwords($name);
                      $file_ext = end($file_ext);
                      if (!in_array($file_ext, $extensions)) {
                      ?><div class="alert alert-danger">
              <?php echo "{$this->file_array[$i]['name']} - Invalid file extension!";
              ?> </div><?php

                      } else {

                        $img_dir = 'img/pid/' . $this->file_array[$i]['name'];
                        move_uploaded_file($this->file_array[$i]['tmp_name'], $img_dir);

                        $this->req = "INSERT INTO piecesidentite (PID_Type, PID_Pays, PID_DateDelivrance, PID_DateExpiration, PID_Personnes_PER_id,PID_Imgnom,PID_Imgdir) VALUES(:typepid,:pays,:delivrance,:expiration,:lastid, :nomimg, :dossimg);";

                        $this->dbh = new \App\Database();
                        $this->dbh->prepareSql($this->req);
                        $this->dbh->bindP(':typepid', $this->typepid, PDO::PARAM_STR);
                        $this->dbh->bindP(':pays', $this->payspid, PDO::PARAM_STR);
                        $this->dbh->bindV(':delivrance', strftime("%Y-%m-%d", strtotime($this->datedelivrance)), PDO::PARAM_STR);
                        $this->dbh->bindV(':expiration', strftime("%Y-%m-%d", strtotime($this->dateexpiration)), PDO::PARAM_STR);
                        $this->dbh->bindP(':lastid', $this->lastid, PDO::PARAM_STR);
                        $this->dbh->bindP(':nomimg', $name, PDO::PARAM_STR);
                        $this->dbh->bindP(':dossimg', $img_dir, PDO::PARAM_STR);
                        $this->dbh->execReq();
                        ?><div class="alert alert-success">
              <?php echo $this->file_array[$i]['name'] . ' - ' . $this->phpFileUploadErrors[$this->file_array[$i]['error']];
              ?></div><?php
                      }
                    }
                  }


                  header('Location: /ressources');
                }
                $chargeTwig = new \App\Twig('pages/pid.html.twig');
                $chargeTwig->render([]);

                return  true;
              }

              
              /**
               * reArrayFiles
               *
               * @param  mixed $file_post
               * @return void
               */
              public function reArrayFiles($file_post)
              {
                $file_ary = array();
                $file_count = count($file_post['name']);
                $file_keys = array_keys($file_post);

                for ($i = 0; $i < $file_count; $i++) {
                  foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                  }
                }
                return $file_ary;
              }
            }
                      ?>