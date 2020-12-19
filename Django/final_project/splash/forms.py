from django import forms
from django.contrib.auth.models import User
from django.contrib.auth.forms import UserCreationForm
from django.core import validators
from .models import *


class CustomUserCreationForm(forms.ModelForm):
    class Meta():
        model = MyUser
        fields = ('email', 'password','is_candidate','is_employer')

        #fields = '__all__'

     
      
      
class candidate_form(forms.ModelForm):
    Name = forms.CharField(widget=forms.TextInput(attrs={'placeholder': 'Type in your Name'}))


    class Meta():
	     model = Candidates
	     fields = '__all__'
      
      
class employer_form(forms.ModelForm):
    Name = forms.CharField(widget=forms.TextInput(attrs={'placeholder': 'Type in your Name'}))


    class Meta():
	     model = Employers
	     fields = '__all__'      
      
class college_info_form(forms.ModelForm):
    Name = forms.CharField(widget=forms.TextInput(attrs={'placeholder': 'Type in your Name'}))

    class Meta():
	     model = Colleges_Info
	     fields = '__all__'
      
class support_form(forms.ModelForm):
    Name = forms.CharField(widget=forms.TextInput(attrs={'placeholder': 'Type in your Name'}))

    class Meta():
	     model = Support
	     fields = '__all__'                 
      

      