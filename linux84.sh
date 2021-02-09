#include <avr/io.h>

const int VOL_PIN = A3;

void setup(){

}

void loop(){

    pinMode(A3,INPUT);
    
    int value;
    float volt;

    value = analogRead( VOL_PIN );

    volt = value * 4.20 / 1023.0;

if(volt < 2)

{

pinMode(0,OUTPUT);

digitalWrite(0,LOW);

pinMode(4,OUTPUT);

digitalWrite(4,HIGH);

delay(12);

}

else

{

pinMode(0,OUTPUT);

digitalWrite(0,LOW);

pinMode(4,INPUT);

digitalWrite(4,LOW);

delay(12);

}

}
