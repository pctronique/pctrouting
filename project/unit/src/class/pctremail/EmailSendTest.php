<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_WWW . '/src/class/pctrpath/PathPhp.php');

/**
 * ClassNameTest
 * @group group
 */
class EmailSendTest extends TestCase
{
    /**
     * @var Create_folder
     */
    protected EmailSend|null $object;
    private string|null $folderSave;
    private string|null $fileValide;
    private string|null $FileError;
    private string|null $FileVerif;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new EmailSend();
        $this->folderSave = __DIR__."/../../upload/";
        if(!is_dir($this->folderSave)) {
            mkdir($this->folderSave, 0777, true);
        }
        $this->fileValide = $this->folderSave."EmailSendValide.txt";
        $this->FileError = $this->folderSave."EmailSendError.txt";
        $this->FileVerif = $this->folderSave."EmailSendVerif.txt";
    }

    private function deleteFile():self {
        if(is_file($this->fileValide)) {
            unlink($this->fileValide);
        }
        if(is_file($this->FileError)) {
            unlink($this->FileError);
        }
        if(is_file($this->FileVerif)) {
            unlink($this->FileVerif);
        }
        return $this;
    }

    private function displayValidated(array|null $tabVal, string|null $name = null, bool $verif = false):self {
        $name = !empty($name) ? $name : "DATA";
        $tabVal = array_unique($tabVal);
        $content = "------------------------------"."\n\n";
        $content .= "-- VALIDATED : ".$name."\n";
        $content .= "------------------------------"."\n";
        foreach ($tabVal as $value) {
            //echo $value."\n";
            $content .= (!empty($value) ? $value : (isset($value) ? $value : "NULL"))."\n";
        }
        file_put_contents($this->fileValide,$content,FILE_APPEND);
        if($verif) {
            file_put_contents($this->FileVerif,$content,FILE_APPEND);
        }
        return $this;
    }

    private function displayError(array|null $tabError, string|null $name = null, bool $verif = false):self {
        $name = !empty($name) ? $name : "DATA";
        $tabError = array_unique($tabError);
        $content = "------------------------------"."\n\n";
        $content .= "-- ERROR : ".$name."\n";
        $content .= "------------------------------"."\n";
        foreach ($tabError as $value) {
            //echo $value."\n";
            $content .= (!empty($value) ? $value : (isset($value) ? $value : "NULL"))."\n";
        }
        file_put_contents($this->FileError,$content,FILE_APPEND);
        if($verif) {
            file_put_contents($this->FileVerif,$content,FILE_APPEND);
        }
        return $this;
    }

        /**
         * Set the value of mail
         */
        public function testSetMailTo(): self
        {
            $this->deleteFile();
            $tabError = [];
            $tabVal = [];
            foreach (array_string_all() as $mail_to) {
                foreach (array_string_all() as $name) {
                    try {
                        $this->object->setMailTo($mail_to, $name)
                                    ->setMailFrom("test@test.fr")
                                    ->send();
                        array_push($tabVal, 'Valeur valide : '.$mail_to);
                    } catch (Throwable $th) {
                        array_push($tabError, 'Problème : '.$th->getMessage());
                    }
                }
            }
            $this->displayValidated($tabVal, "setMailTo", true);
            $this->displayError($tabError, "setMailTo");
            $this->assertNotNull($this->object);
            return $this;
        }

        /**
         * Set the value of mail_from
         */
        public function testSetMailFrom(): self
        {
            $tabError = [];
            $tabVal = [];
            foreach (array_string_all() as $mail_from) {
                foreach (array_string_all() as $name) {
                    try {
                        $this->object->setMailFrom($mail_from, $name)
                                    ->setMailTo("test@test.fr")
                                    ->send();
                        array_push($tabVal, 'Valeur valide : '.$mail_from);
                    } catch (Throwable $th) {
                        array_push($tabError, 'Problème : '.$th->getMessage());
                    }
                }
            }
            $this->displayValidated($tabVal, "setMailFrom", true);
            $this->displayError($tabError, "setMailFrom");
            $this->assertNotNull($this->object);
            return $this;
        }

        /**
         * Set the value of charset
         */
        public function testSetCharset(): self
        {
            $tabError = [];
            $tabVal = [];
            foreach (array_string_all() as $charset) {
                try {
                    $this->object->setMailFrom("test@test.fr")
                                ->setMailTo("test@test.fr")
                                ->setCharset($charset)
                                ->send();
                    array_push($tabVal, 'Valeur valide : '.$charset);
                } catch (Throwable $th) {
                    array_push($tabError, 'Problème : '.$th->getMessage());
                }
            }
            $this->displayValidated($tabVal, "setCharset", true);
            $this->displayError($tabError, "setCharset");
            $this->assertNotNull($this->object);
            return $this;
        }

        /**
         * Set the value of objet
         */
        public function testSetObjet(): self
        {
            $tabError = [];
            $tabVal = [];
            foreach (array_string_all() as $value) {
                $this->object->setMailFrom("test@test.fr")
                                ->setMailTo("test@test.fr")
                                ->setObjet($value)
                                ->send();
                array_push($tabVal, 'Valeur valide : '.$value);
            }
            $this->displayValidated($tabVal, "setObjet");
            $this->displayError($tabError, "setObjet", true);
            $this->assertNotNull($this->object);
            return $this;
        }

        /**
         * Set the value of messageHTML
         */
        public function testSetMessageHTML(): self
        {
            $tabError = [];
            $tabVal = [];
            foreach (array_string_all() as $messageHTML) {
                try {
                    $this->object->setMailFrom("test@test.fr")
                                ->setMailTo("test@test.fr")
                                ->setMessageHTML($messageHTML)
                                ->send();
                    array_push($tabVal, 'Valeur valide : '.$messageHTML);
                } catch (Throwable $th) {
                    array_push($tabError, 'Problème : '.$th->getMessage());
                }
            }
            $this->displayValidated($tabVal, "setMessageHTML");
            $this->displayError($tabError, "setMessageHTML", true);
            $this->assertNotNull($this->object);
            return $this;
        }

        /**
         * Set the value of messageText
         */
        public function testSetMessageText(): self
        {
            $tabError = [];
            $tabVal = [];
            foreach (array_string_all() as $messageText) {
                try {
                    $this->object->setMailFrom("test@test.fr")
                                ->setMailTo("test@test.fr")
                                ->setMessageText($messageText)
                                ->send();
                    array_push($tabVal, 'Valeur valide : '.$messageText);
                } catch (Throwable $th) {
                    array_push($tabError, 'Problème : '.$th->getMessage());
                }
            }
            $this->displayValidated($tabVal, "setMessageText");
            $this->displayError($tabError, "setMessageText", true);
            $this->assertNotNull($this->object);
            return $this;
        }

        /**
         * Set the value of attachment
         */
        public function testAddAttachment(): self
        {
            $tabError = [];
            $tabVal = [];
            foreach (array_string_all() as $attachment) {
                try {
                    $this->object->setMailFrom("test@test.fr")
                                ->setMailTo("test@test.fr")
                                ->addAttachment($attachment)
                                ->send();
                    array_push($tabVal, 'Valeur valide : '.$attachment);
                } catch (Throwable $th) {
                    array_push($tabError, 'Problème : '.$th->getMessage());
                }
            }
            $this->displayValidated($tabVal, "addAttachment", true);
            $this->displayError($tabError, "addAttachment");
            $this->assertNotNull($this->object);
            return $this;
        }

        /**
         * Pour envoyer un message html (si le message ne peut pas etre lut en html, il sera affiche en texte).
         * Si le message texte est vide, il sera remplacer par le htlm (sans les balises).
         */
        public function testSend():self {
            $tabError = [];
            $tabVal = [];
            foreach (array_string_all() as $mail_to) {
                foreach (array_string_all() as $mail_from) {
                    try {
                        if(!empty($mail_to)) {
                            $this->object->setMailFrom($mail_to);
                        }
                        if(!empty($mail_from)) {
                            $this->object->setMailFrom($mail_from);
                        }
                    } catch (Throwable $th) {}
                    try {
                        $this->object->send();
                    } catch (Throwable $th) {
                        array_push($tabError, 'Problème : '.$th->getMessage());
                    }
                }
            }
            $this->displayValidated($tabVal, "send");
            $this->displayError($tabError, "send", true);
            $this->assertNotNull($this->object);
            return $this;
        }
        
}