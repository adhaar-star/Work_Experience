"""final_project URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/3.0/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import include, path
from django.conf import settings
from django.conf.urls.static import static
from splash import views as splash_views

from rest_framework import routers


router = routers.DefaultRouter()
router.register(r'questions', splash_views.QuestionViewSet)
router.register(r'users', splash_views.MyUserViewSet)
router.register(r'candidates', splash_views.CandidateViewSet)
router.register(r'employers', splash_views.EmployerViewSet)
router.register(r'experince', splash_views.ExperienceViewSet)
router.register(r'expertise', splash_views.ExpertiseViewSet)


#from video_content.views import upload_video,display
 


   
from splash import views as splash_views


urlpatterns = [
    path('', splash_views.home, name='home'),
    path('howitworks', splash_views.howitworks, name='howitworks'),
    path('candidate/signup', splash_views.sign_up, name='sign_up'),
    path('candidate/login', splash_views.user_login, name='login'),
    path('employer/register', splash_views.employer_register, name='employer_register'),
    path('candidate/register', splash_views.register, name='register'),
    path('candidate/saveVideo', splash_views.upload_video, name='upload_video'),
    path('candidate/edit/<user_id>', splash_views.candidate_update, name='candidate_update'),
    path('candidate/logout', splash_views.user_logout, name='logout'),
    path('colleges', splash_views.college_info, name='colleges'),
    path('help', splash_views.support, name='support'),
    path('candidate/dashboard/<user_id>',  splash_views.candidate_dashboard, name='candidate_dashboard'),
    path('employer/dashboard/<user_id>',  splash_views.employer_dashboard, name='employer_dashboard'),
    path('admin/', admin.site.urls),
    path('api/v1/', include(router.urls)),
    path('api-auth/v1/', include('rest_framework.urls',namespace='rest_framework')),
    #path('upload/',upload_video,name='upload'),
    #path('videos/',display,name='videos')

]

urlpatterns += static(settings.MEDIA_URL,document_root=settings.MEDIA_ROOT)
