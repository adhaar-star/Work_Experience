from django.db import models
from django.contrib.auth.models import User
from django.contrib.auth.models import AbstractUser
from .managers import CustomUserManager

from django.contrib.auth.models import PermissionsMixin


# Create your models here.

class Videos(models.Model):
    user_id = models.CharField(max_length=100)
    image_name = models.CharField(max_length=100)
    video = models.FileField(upload_to='videos/')
     
    class Meta:
        verbose_name = 'video'
        verbose_name_plural = 'videos'
         
    def __str__(self):
        return self.image_name

class  Experience(models.Model):
    Experience_Id = models.AutoField(primary_key=True)
    Experience_level = models.CharField(max_length=255)
    created_at = models.DateField(auto_now=True, auto_now_add=False)
    modified_at = models.DateField(auto_now=True, auto_now_add=False)

class  Expertise(models.Model):
    Expertise_Id = models.AutoField(primary_key=True)
    Expertise_level = models.CharField(max_length=255)
    created_at = models.DateField(auto_now=True, auto_now_add=False)
    modified_at = models.DateField(auto_now=True, auto_now_add=False) 

class  Questions(models.Model):
    Question_Id = models.AutoField(primary_key=True)
    Question = models.TextField()
    created_at = models.DateField(auto_now=True, auto_now_add=False)
    modified_at = models.DateField(auto_now=True, auto_now_add=False)           

class  Candidates(models.Model):
    candidate_id = models.AutoField(primary_key=True)
    user_id = models.CharField(max_length=255)
    Name = models.CharField(max_length=255)
    experience = models.ForeignKey(Experience, on_delete=models.CASCADE)
    expertise = models.ForeignKey(Expertise, on_delete=models.CASCADE)
    blocked = models.TextField(default=None)
    url = models.TextField()
    question = models.ForeignKey(Questions, on_delete=models.CASCADE)
    video_url = models.TextField()
    created_at = models.DateField(auto_now=True, auto_now_add=False)
    updated_at = models.DateField(auto_now=True, auto_now_add=False)

class  Employers(models.Model):
    employer_id = models.AutoField(primary_key=True)
    user_id = models.CharField(max_length=255)
    Name = models.CharField(max_length=255)
    Phone = models.CharField(max_length=255)
    job_title = models.CharField(max_length=255)
    company_name = models.CharField(max_length=255)
    company_industry = models.CharField(max_length=255)
    
class Colleges_Info(models.Model):
    college_info_id = models.AutoField(primary_key=True)
    Name = models.CharField(max_length=255)
    work_email = models.EmailField('work_email')
    job_title = models.CharField(max_length=255)
    college_name = models.CharField(max_length=255)
    
    
class Support(models.Model):
    support_id = models.AutoField(primary_key=True) 
    Name =  models.CharField(max_length=255)
    email = models.EmailField('email')
    message = models.TextField()
        

class  Skill_Level(models.Model):
    Skill_Id = models.AutoField(primary_key=True)
    Level = models.CharField(max_length=255)
    created_at = models.DateField(auto_now=True, auto_now_add=False)
    modified_at = models.DateField(auto_now=True, auto_now_add=False)


from django.contrib.auth.models import (
    BaseUserManager, AbstractBaseUser
)


class MyUserManager(BaseUserManager):
    def create_user(self, email, password=None):
        """
        Creates and saves a User with the given email, date of
        birth and password.
        """
        if not email:
            raise ValueError('Users must have an email address')

        user = self.model(
            email=self.normalize_email(email),

        )

        user.set_password(password)
        user.save(using=self._db)
        return user

    def create_superuser(self, email, password=None):
        """
        Creates and saves a superuser with the given email, date of
        birth and password.
        """
        user = self.create_user(
            email,
            password=password,
        )
        user.is_admin = True
        user.save(using=self._db)
        return user


class MyUser(AbstractUser):
    username = None
    email = models.EmailField('email', unique=True)
    is_employer = models.BooleanField('is_employer', default=False)
    is_candidate = models.BooleanField('is_candidate', default=False)
    is_admin = models.BooleanField(default=False)

    objects = MyUserManager()


    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = []
    
    
    def __str__(self):
        return self.email
    
    def __str__(self):
        return self.email

    def has_perm(self, perm, obj=None):
        "Does the user have a specific permission?"
        # Simplest possible answer: Yes, always
        return True

    def has_module_perms(self, app_label):
        "Does the user have permissions to view the app `app_label`?"
        # Simplest possible answer: Yes, always
        return True

    @property
    def is_staff(self):
        "Is the user a member of staff?"
        # Simplest possible answer: All admins are staff
        return self.is_admin
    
    




    

class Employee(models.Model):
    Employee_Id = models.AutoField(primary_key=True)
    user_id = models.CharField(max_length=255)
    Name = models.CharField(max_length=255)
    Phone = models.CharField(max_length=255)
    Job_Title = models.CharField(max_length=255)
    company_name = models.CharField(max_length=255)
    company_industry = models.CharField(max_length=255)
    customer_id= models.CharField(max_length=255, default=None)
    created_at = models.DateField(auto_now=True, auto_now_add=False)
    modified_at = models.DateField(auto_now=True, auto_now_add=False)



class Video_Stats(models.Model):
    Video_Id = models.AutoField(primary_key=True)
    user_id = models.CharField(max_length=255)
    video_name = models.CharField(max_length=100)
    created_at = models.DateField(auto_now=True, auto_now_add=False)
    modified_at = models.DateField(auto_now=True, auto_now_add=False) 





    

