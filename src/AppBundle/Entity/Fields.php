<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Fields
{
    protected $name;
	protected $age;
    protected $actDate;
	private $file;
	
	

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
	 public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getactDate()
    {
        return $this->actDate;
    }
	 public function setactDate($actDate)
    {
        $this->actDate = $actDate;
    }
/**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file; 
	}
       /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    
   
	public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
         $metadata->addPropertyConstraint('name', new Assert\NotBlank());
		 
		 $metadata->addPropertyConstraint('name', new Assert\Regex(array(
		 'pattern' => '/^[A-ZА-ЯЁ][a-zа-яё]+\s[A-ZА-ЯЁ][a-zа-яё]+\b/u',
		 'htmlPattern' => '^[A-ZА-ЯЁ][a-zа-яё]+\s[A-ZА-ЯЁ][a-zа-яё]+\b',
		 'message' => 'Пожалуйста напишите фамилию и имя с заглавной буквы через пробел по английски или на русском',
		 )));
		 
         $metadata->addPropertyConstraint('age', new Assert\Range(array(
            'min'        => 17,
            'max'        => 65,
            'minMessage' => 'Ваш возвраст должен быть не менее {{ limit }} лет',
            'maxMessage' => 'Ваш возвраст должен быть не более {{ limit }} лет',
        )));
		$metadata->addPropertyConstraint('actDate', new Assert\NotBlank());
		 $metadata->addPropertyConstraint('actDate', new Assert\Regex(array(
		 'pattern' => '/^[0-3][1-9][-\.\/][0-1][1-9][-\.\/][1-2][0,9][0-9][0-9]/',
		 'htmlPattern' => '^[0-3][1-9][-\.\/][0-1][1-9][-\.\/][1-2][0,9][0-9][0-9]',
		 'message' => 'Вы должны написать дату в формате DD/MM/YYYY или DD.MM.YYYY или DD-MM-YYYY',
		 )));
		$metadata->addPropertyConstraint('file', new Assert\File(array(
            'maxSize' => '1024k',
			'maxSizeMessage'=>'Размер загружаемого файла превышает {{ limit }} КБайт',
			'mimeTypes' => array(
                'application/pdf',
                'application/x-pdf',
				'application/msword',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				 
            ),
			'mimeTypesMessage' => 'Пожалуйста загрузите файлы c расширениями PDF или DOC',
        )));
         
    }
	 

   
	 
}