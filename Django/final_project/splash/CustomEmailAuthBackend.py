from django.contrib.auth.models import *
from .models import *



class EmailAuthBackend(object):
    def authenticate(self,username=None, password=None, **kwargs):
        try:
            user = MyUser.objects.get(email=username)
        except User.DoesNotExist:
            return None
        
        if getattr(user, 'is_active') and user.check_password(password):
            return user
        return None
    
    
def get_user(self,uid):
    try:
        return User.object.get(pk=uid)
    except User.DoesNotExist:
        None