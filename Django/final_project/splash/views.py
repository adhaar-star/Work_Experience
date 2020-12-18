from django.shortcuts import render
from django.shortcuts import render,redirect
from .models import *
from .forms import *
from django.http import JsonResponse
from django.urls import reverse
from django.db import connection, OperationalError
from django.http import HttpResponseRedirect, HttpResponse
from django.db import IntegrityError, transaction
from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.decorators import login_required
from .serializers import *
from rest_framework import viewsets
from rest_framework import permissions





class QuestionViewSet(viewsets.ModelViewSet):
 queryset = Questions.objects.all()
 serializer_class = QuestionSerializer
 permission_classes = [permissions.IsAuthenticated]
 
class MyUserViewSet(viewsets.ModelViewSet):
 queryset = MyUser.objects.all()
 serializer_class = UserSerializer
 permission_classes = [permissions.IsAuthenticated] 
 
class ExpertiseViewSet(viewsets.ModelViewSet):
 queryset = Expertise.objects.all()
 serializer_class = ExpertiseSerializer
 permission_classes = [permissions.IsAuthenticated]
 
 
class ExperienceViewSet(viewsets.ModelViewSet):
 queryset = Experience.objects.all()
 serializer_class = ExperienceSerializer
 permission_classes = [permissions.IsAuthenticated] 
 
class CandidateViewSet(viewsets.ModelViewSet):
 queryset = Candidates.objects.all()
 serializer_class = CandidateSerializer
 permission_classes = [permissions.IsAuthenticated]    
 
 
class EmployerViewSet(viewsets.ModelViewSet):
 queryset = Employers.objects.all()
 serializer_class = EmployerSerializer
 permission_classes = [permissions.IsAuthenticated]     
 
# Create your views here.

def home(request):
    return render(request, 'splash/home.html')
def howitworks(request):
    return render(request, 'splash/howitworks.html')

def college_info(request):
    if request.method == 'POST':
        #return HttpResponse(request.POST.items())
        college_info = college_info_form(request.POST)        
        if college_info.is_valid():
            college_info_saved = college_info.save()
            
            
            college_info_saved.save()
            
            #return HttpResponse(request.POST.items())
            return HttpResponse("Form details successfully saved")
            #return HttpResponse("success")
        else:
            return HttpResponse(college_info.errors)
            
        
    else:                
    
        return render(request, 'splash/colleges.html')
 
@login_required   
def candidate_update(request, user_id):
    return HttpResponse(request.POST.items())
    candidates = Candidates.objects.get(user_id=user_id)

	form = candidate_form(instance=candidates)     
    if request.method == 'POST':
        form = candidate_form(request.POST, instance=candidates)
        if form.is_valid():                       
            candidate_details = form.save()
            candidate_details.save()
            return HttpResponse("Form details successfully updated")
        else:
            return HttpResponse(form.errors)
    else:       
    context = {'form':candidates}
    return render(request, 'splash/candidate_edit_profile.html', context)


@login_required   
def employer_update(request, pk):    
    employers = Employers.objects.get(id=pk)
    form = employer_form(instance=employers)
    if request.method == 'POST':
        if form.is_valid():                       
            employer_details = form.save()
            employer_details.save()
            return HttpResponse("Form details successfully updated")
        else:
            return HttpResponse(form.errors)            
    context = {'form':form}
    return render(request, 'splash/employer_edit.html', context)

        
        
       
def support(request):
    if request.method == 'POST':
        #return HttpResponse(request.POST.items())
        support = support_form(request.POST)        
        if support.is_valid():
            support_info_saved = support.save()
            support_info_saved.save()
            
            #return HttpResponse(request.POST.items())
            return HttpResponse("Form details successfully saved")
            #return HttpResponse("success")
        else:
            return HttpResponse(support.errors)
            
        
    else:                
    
        return render(request, 'splash/support.html')    
    
    

def user_login(request):
    if request.method == 'POST':
        #return HttpResponse(request.POST.items())
        email = request.POST.get('email')

        #email = request.POST('email')
        password = request.POST.get('password')
        user_form = CustomUserCreationForm(request.POST)
        try:    
        #user = authenticate(email=email,password=password)
            user = MyUser.objects.get(email=email,password=password)
            if user:
                if user.is_active:
                #return HttpResponse(user.email)
       
                    login(request,user)
                    if user.is_candidate == True:                    
                        candidate = Candidates.objects.get(user_id=user.email)
                        context = {'candidate': candidate}
                        return redirect('candidate_dashboard',user_id=candidate.user_id)
                    else:
                        employer = Employers.objects.get(user_id=user.email)
                        context = {'employer': employer}
                        return redirect('employer_dashboard',user_id=employer.user_id)
                    
                    
            
                #return HttpResponseRedirect(reverse('dashboard',))
                else:

                    return HttpResponse("Your account is not active.")
            else:
                print("Someone tried to login and failed.")
                print("They used username: {} and password: {}".format(email,password))
                return HttpResponse("Invalid login details supplied.")
        except:
           return HttpResponse("Invalid login details supplied.")        
    else:
        return render(request, 'splash/login.html')


def sign_up(request):
    questions = Questions.objects.all()
    experiences = Experience.objects.all()
    expertises = Expertise.objects.all()
    context = {'questions':questions,'expertises':expertises,'experiences':experiences}
    return render(request, 'splash/sign_up_1.html',context)

def employer_register(request):
    form = employer_form(request.POST)
    if request.method == 'POST':
            #return HttpResponse(request.POST.items())
            username = request.POST['Name']    
            email = request.POST['email']
            password = request.POST['employer_password']           
            profile_data = {"username":username,"email":email,"password":password,"is_candidate":False,"is_employer":True}
            profile_form = CustomUserCreationForm(profile_data)
            if profile_form.is_valid():
                profile_form.save()
            else:
                return HttpResponse(profile_form.errors)
            
            user_id = MyUser.objects.latest('id')
            
            Name = request.POST['Name']
            email = request.POST['email']
            phone= request.POST['phone']
            job_title= request.POST['job_title']
            company_name= request.POST['company_name']
            company_industry= request.POST['company_industry']
            
            data2 = {"Name":Name,"user_id":user_id,"email":email,"Phone":phone,"job_title":job_title,"company_name":company_name,"company_industry":company_industry}
            
            form2 = employer_form(data2)  
                #candidate_form = candidate_form(data=request.POST) 
            if form2.is_valid(): 
                employer = form2.save()
                employer.save()
                return redirect('/candidate/login')
            else:
                return HttpResponse(form2.errors)

          
    return render(request, 'splash/employer_registeration_page.html')

@login_required  
def update_profile(request, user_id):
    user = User.objects.get(pk=user_id)
    user.profile.bio = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...'
    user.save()

def register(request):
    # if request is not post, initialize an empty form
    form = candidate_form(request.POST)
    if request.method == 'POST':
                #return HttpResponse(request.POST.items())
            username = request.POST['candidatename']    
            email = request.POST['candidateemail']
            password = request.POST['candidatepassword']           
            profile_data = {"username":username,"email":email,"password":password,"is_candidate":True,"is_employer":False}
            profile_form = CustomUserCreationForm(profile_data)
            if profile_form.is_valid():
                profile_form.save()
            else:
                return HttpResponse(profile_form.errors)      
                                       
            user_id = MyUser.objects.latest('id')
                
            Name = request.POST['candidatename']
            experience = Experience.objects.get(Experience_Id = request.POST['candidateexperience[]'])
            expertise = Expertise.objects.get(Expertise_Id = request.POST['candidateexpertise[]'])
            question = Questions.objects.get(Question_Id = request.POST['chosen_question'])
            blocked = request.POST['candidateblockedlist']
            url = request.POST['candidateurl']
            video_url = request.POST['video']
            
            data2 = {"Name":Name,"user_id":user_id,"experience":experience,"expertise":expertise,"question":question,"blocked":blocked,"url":url,"video_url":video_url}
            
            form2 = candidate_form(data2)  
                #candidate_form = candidate_form(data=request.POST) 
            if form2.is_valid(): 
                candidate = form2.save()
                candidate.save()
                return redirect('/candidate/login')
            else:
                return HttpResponse(form2.errors)
                #candidate_details = Candidates(Name=Name,user_id=user_id,experience=experience,expertise=expertise,video_url=
   # video_url,blocked=blocked,url=url)
    
        
@login_required
def candidate_dashboard(request, user_id):
    candidate = Candidates.objects.get(user_id=user_id)
    context = {'candidate':candidate}
    return render(request,'splash/candidate_dashboard.html',context)


@login_required
def employer_dashboard(request, user_id):
    employer = Employers.objects.get(user_id=user_id)
    candidates = Candidates.objects.all()
    candidates_length = Candidates.objects.all().count()
    context = {'employer':employer,'candidates':candidates,'length':candidates_length}
    return render(request,'splash/employer_dashboard.html',context)


@login_required
def user_logout(request):
    logout(request)
    return HttpResponseRedirect(reverse('login'))

def upload_video(request):

    if request.method == 'POST':
        user_id = request.POST['user_id']
        image_name = request.POST['image_name']
        video = request.FILES.get('video')
    
        content = Videos(user_id=user_id,image_name=image_name,video=video)
        content.save()
        data = {}
        data['image_name'] = request.POST['image_name']
        return JsonResponse(data)

    return render(request,'splash/sign_up_1.html')