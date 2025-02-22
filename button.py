from kivy.app import App
from kivy.uix.button import Button 
from kivy.uix.boxlayout import BoxLayout
from kivy.utils import get_color_from_hex

class GreenButtonApp(App):
     def build(self):
        
          layout = BoxLayout(orientation='horizontal',padding=15,width=40,height=50)
          green_button =Button(text='cliquer',color=get_color_from_hex('#FFFFFF'))
          layout.add_widget(green_button)
          return layout

if __name__ == "__main__":
    GreenButtonApp().run()