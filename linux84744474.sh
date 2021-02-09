#include <SSD1306_minimal.h>
#include <TinyWireM.h>
#include <USI_TWI_Master.h>

#include <avr/pgmspace.h>

#define DEG "\xa7" "C"

SSD1306_Mini oled; // Declare the OLED object

void splash() {
 oled.startScreen();
 oled.clear(); // Clears the display

 oled.cursorTo(0, 0); // x:0, y:0
 oled.printString("Hello World!");
 oled.cursorTo(0, 10); // x:0, y:23
 oled.printString("ATtiny85!");
}

void setup() {
 oled.init(0x3D); // Initializes the display to the specified address
 oled.clear(); // Clears the display
 delay(1000); // Delay for 1 second
 splash(); // Write something to the display (refer to the splash() method
}

void loop() {
}
