# Generated by Django 3.1.4 on 2020-12-17 03:12

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('splash', '0002_colleges_info'),
    ]

    operations = [
        migrations.CreateModel(
            name='Support',
            fields=[
                ('support_id', models.AutoField(primary_key=True, serialize=False)),
                ('Name', models.CharField(max_length=255)),
                ('email', models.EmailField(max_length=254, verbose_name='email')),
                ('message', models.TextField()),
            ],
        ),
    ]
