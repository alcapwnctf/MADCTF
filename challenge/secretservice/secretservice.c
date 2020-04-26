// gcc secretservice.c -no-pie -o secretservice

#include<stdio.h>
#include<string.h>
#include<stdlib.h>

char *path = "/bin/.secret.flag";

void initialize(){
  setvbuf(stdout, NULL, _IONBF, 0);
  setvbuf(stderr, NULL, _IONBF, 0);
  setvbuf(stdin, NULL, _IONBF, 0);
}

char FLAGS [200][180];


int loadallFlags(){
    memset(FLAGS, 0, sizeof(FLAGS));
    FILE *fp = fopen(path, "r");
    if(fp == NULL)return 0;
    
    char line[180] = {0};
    
    int i = 0;
    while(fgets(line,180,fp)){
        line[strlen(line)-1] = 0;
        strncpy(FLAGS[i],line,180);
        i+=1;
    }
    return i;
}

char* xorflag(char* flag){
    char key[] ="\x01\x02\x03\x04\x05\x06\x07\x08\x09\x00";

    int keypos=0, flagpos;
    for (flagpos=0; flagpos<strlen(flag); flagpos++){
        flag[flagpos] = flag[flagpos] ^ key[keypos];
        if (keypos < strlen(key))keypos++;
    }
    return flag;
}

void viewFlag(){
    if (!loadallFlags()){
        puts("Flags could not be loaded\n");
        return;
    }

    char flagid[60], flag[120];
    
    printf("Enter FLAG ID > ");
    fgets(flagid,600,stdin);
    char* ret = strchr(flagid,'\n');
    if (ret != NULL)*ret = 0;
    printf("Finding flags with ID ");
    printf(flagid);
    puts("");

    int i;
    for (i=0;i<200;i++) {
        if (!strncmp(FLAGS[i],flagid, strlen(flagid))){
            ret = strchr(FLAGS[i],':');
            if (ret != NULL)printf("FLAG: %s\n",xorflag(&FLAGS[i][ret-FLAGS[i]+1]));
            else puts("Flag could not be found");
            break;
        }
    }
    if (i==200)puts("Flag could not be found");
}

int saveFlag(char* flagid, char* flag){
    FILE *fp;
    int retval = 1;
    fp = fopen(path,"a");
    if (fp == NULL){
        puts("FP NULL");
        return 0;
    } 
    char buffer [183] = {0};
    sprintf(buffer,"%s:%s\n",flagid,xorflag(flag));
    if (fputs(buffer, fp) < 0)return 0;
    fclose(fp);
    return retval;
}

void addFlag(){
    char flagid[60], flag[120];
    char* ret;
    
    printf("Enter FLAG ID > ");
    fgets(flagid,60,stdin);
    ret = strchr(flagid,'\n');
    if (ret != NULL)*ret = 0;

    printf("Enter FLAG > ");
    fgets(flag,600,stdin);
    ret = strchr(flag,'\n');
    if (ret != NULL)*ret = 0;

    if (saveFlag(flagid, flag))printf("Flag saved with id %s\n", flagid);
    else puts("Flag could not be saved");
}

int main(int argc, char **argv){
    if (argc > 2){
        path = argv[1];
    }
    initialize();
    while(1){
        puts("Welcome to the secret service");
        puts("A. Add a flag");
        puts("R. Retrieve a flag");
        puts("E. Exit");
        printf("> ");

        char c[3];
        fgets(c,3,stdin);
        switch(c[0]){
            case 'A': addFlag(); break;
            case 'R': viewFlag(); break;
            case 'E': exit(0);break;
            default: exit(1);
        }
    }
}
