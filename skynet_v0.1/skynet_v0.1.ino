#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
#include "Adafruit_NeoPixel.h" 
#include "Timer.h" 
#include "Servo.h"

#define PIXEL_PIN   D3
#define PIXEL_COUNT 12
Adafruit_NeoPixel strip = Adafruit_NeoPixel(PIXEL_COUNT, PIXEL_PIN, NEO_GRB + NEO_KHZ800);
Timer t;
Servo accelerator;
Servo trigger;

const char *ssid = "munichmakerlab";
const char *password = "h4ckingr00m";



byte toShoot = 0;

byte sequenceIndex = 0;
volatile bool shouldShoot = true;
volatile int debounceCounter = 0;


void ledOnWith(long color){
  strip.setPixelColor(0, color); 
  strip.show();
}

void ledOffWith(){
  strip.clear(); 
  strip.show();
}

ESP8266WebServer server(80);

const int led = LED_BUILTIN;

void handleRoot() {
  server.send(200, "text/plain", "hello from esp8266!");
  //shouldShoot = false;
}

void ledOn() {
  shouldShoot = true;
  server.send(200, "text/plain", "Pew Pew!");
}

void ledOff() {
  ledOffWith();
  server.send(200, "text/plain", "LED off ");
}

void handleNotFound(){
  digitalWrite(led, 1);
  String message = "File Not Found\n\n";
  message += "URI: ";
  message += server.uri();
  message += "\nMethod: ";
  message += (server.method() == HTTP_GET)?"GET":"POST";
  message += "\nArguments: ";
  message += server.args();
  message += "\n";
  for (uint8_t i=0; i<server.args(); i++){
    message += " " + server.argName(i) + ": " + server.arg(i) + "\n";
  }
  server.send(404, "text/plain", message);
  digitalWrite(led, 0);
}

void setup(void){
  WiFi.disconnect(true);
  
  Serial.begin(9600);
  
  strip.begin();
  blue();
  t.every(50, rainbowCycle); // 200
  t.every(10, checkButton); // 200
  t.every(100, checkShoot); // 200
  t.every(300, shoot); // 200

  attachServos();
  updateServos(95,95);
  delay(1000);
  detachServos();

  
   WiFi.begin(ssid, password);
  Serial.println("");

  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  /*

  WiFi.softAP(ssid, password);

 IPAddress myIP = WiFi.softAPIP();
  Serial.print("AP IP address: ");
  Serial.println(myIP);
  
  if (MDNS.begin("esp8266")) {
    Serial.println("MDNS responder started");
  }
  */
  server.on("/", handleRoot);
  server.on("/shoot", ledOn);
  //server.on("/off", ledOff);

  server.onNotFound(handleNotFound);

  server.begin();
  Serial.println("HTTP server started");
}

void loop(void){
  server.handleClient();
  t.update();
}

void checkButton(){
  if(!digitalRead(D4)){
    debounceCounter++;
  }
}

void checkShoot(){
  if(debounceCounter > 1){
    debounceCounter = 0;
    shouldShoot = true;
  }else{
    debounceCounter = 0;
  }
}

void trigga(){
  shouldShoot = true;
}

void shoot(){
     if(shouldShoot){
       if(sequenceIndex == 0){
          sequenceIndex++;
          attachServos();
          updateServos(170,95);
          delay(100);
          detachServos();
          red();
       }else if(sequenceIndex == 1){
          sequenceIndex++;
          attachServos();
          updateServos(170,1);
          delay(100);
          //detachServos();
          green();
       }else if(sequenceIndex == 2){
          sequenceIndex = 0;
          shouldShoot = false;
          attachServos();
          updateServos(95,95);
          blue();
          delay(100);
          detachServos();
       }
     }
}

// Input a value 0 to 255 to get a color value.
// The colours are a transition r - g - b - back to r.
uint32_t Wheel(byte WheelPos) {
  WheelPos = 255 - WheelPos;
  if(WheelPos < 85) {
    return strip.Color(255 - WheelPos * 3, 0, WheelPos * 3);
  }
  if(WheelPos < 170) {
    WheelPos -= 85;
    return strip.Color(0, WheelPos * 3, 255 - WheelPos * 3);
  }
  WheelPos -= 170;
  return strip.Color(WheelPos * 3, 255 - WheelPos * 3, 0);
}

// Slightly different, this makes the rainbow equally distributed throughout
void rainbowCycle() {
  uint16_t i, j, minimum,maximum;
  uint8_t wait = 50;
  minimum = 0;
  maximum = 256;
  if(true){

    for(j=0; j<256*5; j++) { // 5 cycles of all colors on wheel
    for(i=0; i< strip.numPixels(); i++) {
        strip.setPixelColor(i, Wheel(((i * 256 / strip.numPixels()) + j) & 255));
    }
    strip.show();
    delay(3);
  }
  }
}

void green(){
  strip.clear();
  for(uint16_t i=0; i<strip.numPixels(); i++) {
    strip.setPixelColor(i, 255, 0, 0);//63, 136, 143
  }
  strip.show();
}

void blue(){
  strip.clear();
  for(uint16_t i=0; i<strip.numPixels(); i++) {
    strip.setPixelColor(i, 0, 255, 0);//63, 136, 143
  }
  strip.show();
}

void red(){
  strip.clear();
  for(uint16_t i=0; i<strip.numPixels(); i++) {
    strip.setPixelColor(i, 0, 0, 255);//63, 136, 143
  }
  strip.show();
}


void attachServos(){
  accelerator.attach(D2); 
  trigger.attach(D1); 
}
void detachServos(){
  accelerator.detach(); 
  trigger.detach(); 
}
void updateServos(int leftVelocity, int rightVelocity){
  accelerator.write(leftVelocity);
  trigger.write(rightVelocity); 
}

void shootSequence(){
  attachServos();
  updateServos(95,95);

  
  delay(1000);
  updateServos(170,95);
  delay(3000);
  
  updateServos(170,1);
  delay(1000);
  updateServos(95,95);
  delay(1000);
  detachServos();
}

