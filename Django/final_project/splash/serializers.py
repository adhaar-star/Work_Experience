from .models import *
from rest_framework import serializers
from django.contrib.auth.models import User

class UserSerializer(serializers.HyperlinkedModelSerializer):
 class Meta:
  model = MyUser
  fields = ['email', 'is_candidate', 'is_employer']
  
  
class QuestionSerializer(serializers.HyperlinkedModelSerializer):
 class Meta:
  model = Questions
  fields = ['Question', 'created_at']  
  
  
class ExpertiseSerializer(serializers.HyperlinkedModelSerializer):
 class Meta:
  model = Expertise
  fields = ['Expertise_level', 'created_at']    
  
  
class ExperienceSerializer(serializers.HyperlinkedModelSerializer):
 class Meta:
  model = Experience
  fields = ['Experience_level', 'created_at']
  
  
class CandidateSerializer(serializers.HyperlinkedModelSerializer):
 class Meta:
  model = Candidates
  fields = ['user_id', 'Name', 'experience', 'expertise', 'blocked', 'url', 'question', 'video_url', 'created_at']   
  
   
class EmployerSerializer(serializers.HyperlinkedModelSerializer):
 class Meta:
  model = Employers
  fields = ['user_id', 'Name', 'Phone', 'job_title', 'company_name', 'company_industry']             