<div class="sidebar-wrapper">
   <div class="logo-wrapper">
      <center>
         <a href="{{route('index')}}"><img class="img-fluid for-light" src="{{asset('logo.jpeg')}}" style="height: 80px; width: 80px;" alt=""></a>
      </center>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
   </div>
   <div class="logo-icon-wrapper"><a href="{{route('index')}}"><img class="img-fluid" src="{{asset('logo.jpeg')}}" style="height: 50px" alt=""></a></div>
   <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
         <ul class="sidebar-links custom-scrollbar">
            <li class="back-btn">
               <a href="{{route('index')}}"><img class="img-fluid" alt=""></a>
               <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
            </li>
            <li class="sidebar-list">
               <a href="/home" class="sidebar-link sidebar-title {{ strpos(Request::url(),'home') ? 'active' : '' }}" style="cursor: pointer;">
                  <img src="https://img.icons8.com/ios/25/000000/dashboard.png" />
                  <span class="lan-3">Dashboard</span>
               </a>
            </li>
            @hasanyrole('manager|supManager')
            <li class="sidebar-list">
               <a href="/user" class="sidebar-link sidebar-title {{ strpos(Request::url(),'users') ? 'active' : '' }}" style="cursor: pointer;">
                  <img src="https://img.icons8.com/ios/30/000000/conference-background-selected.png" />
                  <span>Usuarios</span>
               </a>
            </li>
            @endhasanyrole
            <li class="sidebar-list">
               <a href="/client" class="sidebar-link sidebar-title {{ strpos(Request::url(),'User') ? 'active' : '' }}" style="cursor: pointer;">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAADtElEQVRIibWXTUgjZxjHn8TN1tClpCFiJWGLEWSMXcVWjwZkaHIQQU8JRKIsCBVXFER62ksvngoKdbEKoRIt3hsYY01JDOma0W1FEBJN4geokESbSXZYk8zM00uzmJVMxln7O83wvvx/L+8878cA3B8VALQYjUYSAEwAoJSRAQqpHdva2r7q7Ox82d7e3tHV1fVlXV3d46urq+Lm5mYkFAotUhT1k5wBiNLb2/t8bW3tHCsQiUTe9fX1ff+gUpIkv6UoKllJWiIQCPwzMzOzS5LkjwDw+KPF09PT/mrS2zAMI9hsttWPkhoMhmfBYJC9jxgR0efzMQaD4ZlscU9Pz0uO46qKlpeXcX5+HvP5PCIi8jyPJEn+IJYtuhS0Wq2mpqamYvv+/j7Mzs6C2WwGp9MJc3NzIAgCKJVK0Gg0n4plPxJrzOfz2dJzLBaDUCj0PpjjOCAIAiYnJ9/3dzqdsLCwUBwdHVVls9kr2eJUKpVIpVLg8Xg4vV7/aHBwEMRmoL6+HqLRaD4WiynPzs7+EssWnepwOExtbGzk9vb2BIvFIiotcXNzo1pfX89Eo1G/bLHVan2eTqefKBQKyeuytrb2E0EQtBaL5YVsMcdxtTqdToGIUr0AANDQ0KDgeV4tW0zT9Kvz8/MTnU4nWarT6eD09PSYpulXssW5XC5NUdSoWq1mpYrVavVbj8fzXS6XE63qqkea3+9fTyaTr6WKk8nk662trY1q/SSdpdvb278nEgm+Wr94PM6Hw2GvlEypKB0Oxx8sW3nbZlkWHQ7HJsi8GFREo9FohoeH0/F4/I40Fovh0NBQWqvVfiY1T3Tnuk0mk8no9fo3R0dHFq/XC62trQAAcHBwAE1NTWAwGN5cX19nq8TcS/x5d3f3UEtLy9eI2GG1WgEA4PDwEBQKBZjNZgAACAQCHSMjI8uRSOTvYDD4CwBkpA7iQ9QDAwNzS0tLJwzDICKi2+3Gy8vLO1N9cXGBbrcbEREZhsHFxcWT/v7+WQAQ3UTuYDQan46Pj4c+LCae53FlZQVdLhfSNI00TaPL5cLV1VUUBOFOsY2NjQWNRuNTqd4nExMTf4od/CzL4s7ODu7u7qJYpSMiTk1NhQGgetHZ7fZfC4WCaNh9KBQKaLPZVkSlBEF84/P5rh/M+h9erzdtMpk6KoptNtvPDy0tYbfbyy78ZbsMQRCmqt9CJs3NzWW3zrJ1zHHcF4lE4n8R8zzfcPu97N+psbGxT6VSVb/fyKBYLPLHx8e/ld7/Bf0H0LjvYWrbAAAAAElFTkSuQmCC">
                  <span class="lan-3">Clientes</span>
               </a>
            </li>
            <li class="sidebar-list">
               <a href="/credit" class="sidebar-link sidebar-title {{ strpos(Request::url(),'Credit') ? 'active' : '' }}" style="cursor: pointer;">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAArklEQVRIie2WsQ3CMBBFH1HYINQwACUjkFkoGIE1oGAFGIECFqBLeqhhA5CgiIycE6Tyl1B0r7rzWX7nwvKB4/SNQRRPgQ3wAF4CzxBYApUt7oFxYmHMBNiFJIsKBXAVii/AKCS5Kc6F4hZWfBD7Tr/EpVi8+rZ4FEtbDntjgAVwpnlSs454m7wbIR9H1rVLiYtd3G/xHf23eAuJHQTWwBPNIJDTDAJ14rMd5094A/XjGjR3DIQ1AAAAAElFTkSuQmCC" />
                  <span>Solicitud De Créditos</span>
               </a>
            </li>
            <li class="sidebar-list">
               <a href="/cancelled-credits" class="sidebar-link sidebar-title {{ strpos(Request::url(),'Cancelled-credits') ? 'active' : '' }}" style="cursor: pointer;">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABJUlEQVRIie3WIUsEQRjG8d/J+Tk8YaM2gx9AP4ZBEAStNrtBTKLBZLDpN7BcMJgEg2IRtJgUDRcMBg3rnsu6A7c7AwfHPTAws+/s/t9n3p1hmGpM6iEbF/hqouHdUn8RR7jFBvoY4CUBp4NZbOOuGrzAXGmc4Vo65z2c1wX6gckpl33I6FYCKzWTd3CGPXwmSuBfNt817QHLeArEm7Sg49VAUu+/sUvs47Glud26h3U1riq25kHHsIkb+dIsVfonWJfXfE175/XZjKC2zoeMmYYvFnqWOz5tAY8CR8NjwFHwWHBreApwK3gqcGN4SnAjeBn8Jt+fKeDFIVOGz+O1GHRKgQUc40t+UsVogAMc4sPfRWAL95HfHkmTf4cLKZPm/5mquX4A3SNUaO5s/vwAAAAASUVORK5CYII=" />
                  <span>Créditos Rechazados</span>
               </a>
            </li>
            <li class="sidebar-list">
               <a href="/insurance" class="sidebar-link sidebar-title {{   in_array(request()->route()->getPrefix(), ['/color-version', '/page-layout'] ) ? 'active' : '' }}" style="cursor: pointer;">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAACOklEQVRIie3US4iOURzH8Y8xuaTYoGxdMhsrG2xIzGiaNLmMGeZiQZSxQDZyyYZy3blLWSg7ewuUhZKVNJHs3MJg3G1YnPOM45nnfZ93MqaUX516n///f/7f8/6e/3P4r1HSmCq5yViAGejHIzws6TcHczENz3AH72s9zCxcwbcIvI/n+IF7WFOwpxV3Y81LPMCnuC5gZhm0BQO4JvzbuiQ3FXvwBucxNuZP4S0OYHpSX4998TDHqkEX4Qu2lxxutmD5cRzFYzRU6PcOJ/16pXX5onr04UgJNNNcfI6rCLoEH3Aoic3C7cga1Cq8wqQkVocewabGgub7sLcg3hQPtD+JNeCpYHtLWnwxrlQn8EIYtHwjmCJMfqqVwuvancTmxT6XcBVn0w03sCvXpB/N8fdifCyAp1orfAm9SWw+XuOM4OBuXE833cKOXKM+v1tZDd4ZoZuS2EJh2tPh2omb6cbLOJ1r1hibbS2Bb4p1nbm6ARzO9TwnWD6oDuGmGZ8rbC2B98b82iS/XLg48s5MFC6i9jQ4AU+ESyCvavCvwkBlajF0uDIdjIxx+cSy2Gj9MOBNyfPquL/oAuqI+5cW5EBXLGgvyBXBM22Iuc1VoN2VoJnaDR2WTM2ClduSWDbRGwvq2wQXesqgw4VvwfcKdcOGZuqO8I6CXGZ7frgy1WxvGbzSwK0oiK//U2imdbFRVw21mb1/DB0OfMShtcDbjJC9ZfDukthfh48aNFN2aVT61v86fNSh/65+ApQVn5haeIjQAAAAAElFTkSuQmCC" />
                  <span>Seguros</span>
               </a>
            </li>
            <!-- <li class="sidebar-list">
               <a href="/saving" class="sidebar-link sidebar-title {{   in_array(request()->route()->getPrefix(), ['/color-version', '/page-layout'] ) ? 'active' : '' }}">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAACZklEQVRIibXWX4jNWxQH8I9xpPE3mppCQgmRPFxREm5GCiVNyp/y4NUVuuXlPigpFErkAQ+6XijKw8x4oMQLQgmJhFDuEw/S+HeNh7V/zemY4+xz5vjWap+z99q/79p7/dlriMAs7MIU9eML7uE0XuZuGpJI7+Bt+kA9WIY+jEQJO3Aid/MpPENrnaRwA/9idBq/ozNnYwnTcQu9DRB/wJg0bsFEHMLFZMQMdOM5HpTJ/XKrG8Hf+Iz1aMMGcfXz0/oo7EMP3qS1PpwcLPEwcbq+CllbRX88lmJyqUHCAl+xDrMxEy0iyrur6L/DNcLHzcCjJNloaRJxgVb8h4VV1udiP1bUQ/wX5tTQGYl2TCqbmyiC8H6SrSL9agZXCQeFPx9h0S9020RwFbncLtK0F+ewRgSkHOI9ImWO4qYIkLZMYliOsQOdphY6cAHbxRX9g08Z+wpcGWgyh/gJ/hR+e4PddZASb8GIAb5Z86qn4QXeY1MNksqr7vBzcelDV05UP8c8dOGsX78+73Act9P/wredyYgOXBX1va6SuS1ZXC1PK9GZ9ItgXIrruJFz4tXYnH5fTOPkTOJytIpAW0xecE3DEWHtXHwUVteLoUnkEh8T1u4V/l4lyuKgkEP8HQfESa/hYcV6USbL0StaqUERFzhWZb5H8lsF/mgWcTWMwyX9hk3AmTT/W4nhtYjY8aLPqolmv8e7VHfJbyUenqvYIqK22QZkET/FAo019A2jhMPYKPLzbua+V6KdKbAS50VlGwin8X8l8WORczsxNZP4m343ncMSkT6vk3wWbdIIXNb/HhdNQdcPviONs5bIJnAAAAAASUVORK5CYII=" />
                  <span>Ahorro-Inversión</span>
               </a>
            </li> -->
            <li class="sidebar-list">
               <a href="/payment" class="sidebar-link sidebar-title {{ strpos(Request::url(),'Payment') ? 'active' : '' }}" style="cursor: pointer;">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAB/0lEQVRIie3VTYiNYRQH8N+9c5NIPmZ8NgpRFmRBWChME3c5K4tpYoq9nSQ1C7sRsVWoCaVEFpJppthgIR+DzciklMyKjMbIcC2e5za3d+59vfeWxdT919t77znnOf9zznPOeWmiiSbmOnL/yW8ei1P0E/U4a8NFPMcH3ESn6sGfRynluZE14724hT+4jZ84iM14jQu4HuWwGntS/D3LQtqNKQyjtUKeQxGDMaDP6MOKTKn8A6ei0wHMS7HbissxwAkcapSwgEvCfZwx+x4L6MW6hHylcBXfsCDKVglV68aaNNJFuI9fOFbDpisGNR2JOip0B6JuIw7HIMpN9R1HaxFficbFGvo8HuMFjmM0On0jVOct3mNnDD7Z0dPYXc3xE1ytFRXOCvfeWRFIEXeFBnuELTGBWuN0rR7i9bgTD55ICayMeynEQ/kMDtbiKcaE2TyC/gznRlJ0r6oJkxm3C2XrxZIq9q3Yj5aEfBk+mZ3tOJZnIU5iF3ri75zQSCWcq2K7AQ/wW+iLIWwizGO96ME+oUFasDTK26rYjgmrtTzTk2VFI8QloZMJo9Eh7PKBlDOTSUGW5kpiVChhe/z/UvhqfanHSU4oUZ+ZXdyFr3iYsJ3CaaG8I9F+ED/qj91wAQuxzcw9fIzv7Qnj8v4dF7bSSezA/AaI3zVwpok5hr9TboSDi+1p+wAAAABJRU5ErkJggg==" />
                  <span>Pagos</span>
               </a>
            </li>
            <li class="sidebar-list">
               <a href="/report" class="sidebar-link sidebar-title {{   in_array(request()->route()->getPrefix(), ['/color-version', '/page-layout'] ) ? 'active' : '' }}">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAB5UlEQVRIieXXPYxMURQH8J+3PkO22BGNZjJRUUjY7SQKotBIbHYjG8VWEt3WFNZWSpVaFBoSElSIgg2GQkNFoVCI3UJBCGsV9443Jm/ex7zX7T+5ufPOPff873nnnHvesNGwaYi8hXZFW+/xtd5xmMd6xfEGu8sSbC5Yf4e3BTo7cRIH8RDHsVr2AIPoebxYQrdtBM+TUU+Wged4IHj+qIi8SeKfmC5L3iRxB5fxAb+kMW9VMVInxoNjPmtTUVaXwRfMZshn4shEE8TfcCtDfiBvU5MxroSNR9xEjHtIhCSbwyT2RPk5fMdt/CkyUqWcCCX1WlpCP/ApEvZkXaHW/52yLtp4gcN4hhPYhb0Yj8/LmIrrnWwzAWU9TqSeXsPYEL2xuL6Olzl6pYnPRL2necb6yJej/mzdVz0X5yWsFeiuRT04WzerJ4Wu9CRDfixDf2ucp+oSt7CC3wPyI7iSs2+iLvEqJrBFaIWDuC9kcg87cAkrdYm7OIWjQuMfxGNc7XuejvOrIuIZ7M9Z3xfnRSHOeQm2DRfi75vDlEb5vO2v44UoW+gjvS69wZJhHt8TMrMMxnED54XPnSUh5rAdp3ERh/BZeIuFd3ZZdKSXw7DRVf3fSSkkgjd38FHaKO4KXeu/y+ovy6eKmJSxKJIAAAAASUVORK5CYII=" />
                  <span>Reportes</span>
               </a>
            </li>
            <li class="sidebar-list">
               <a href="/expense" class="sidebar-link sidebar-title {{   in_array(request()->route()->getPrefix(), ['/color-version', '/page-layout'] ) ? 'active' : '' }}">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAACfUlEQVRIie3WPWiWVxQH8F9i0lgxraZqY1Q0ViUpTqUIWgQHBxUHheokuhTBQRfpIOJHatulk7abTq6C6CJIRaR0cIi4JRq/Kkn9rFZM/Gqb6HDOS17SN3kVH+LiHx7ufXjuPf97znPuOX/eY5xQUzbfhz14jKd4gYe4gz7cxnVcwmX0575GtOXTihbMQjOa0IBJ+AgH0AF1ZcQtOIVDmIwPc+OnmI1l2IK5mIDe3DcHg7iJHtzCRdzNgz/DAHYkh5HE0qszVaLUgM/wU76vwrWM0FjYUP5Sm4Y2oL3KxhJeoEuEvy/n1UhLaE+uhjocwxIRvu7XNDAWduf4wyjEP2NTHVZjBTYXQLoc6/ESp9E54vtxHMW5WvGfnxdAujnJrotE+x1rKqx7jrraAghL6MC32IivxdX5cbTFI7P6bdAkkq2EI+JKVUSRHh9Msm2oT9Ij40G8H9/jO1xRJVmLJB4SXs/DYfyCneNB/I0or0/EHd6KXeNBvD3JS2gUdboiiszqXaJAfCGaxlrRGCqiSI9P4SvRreaL5jFqVhfpMVzAyZz/NtbCoomp3Bz+hyJD/UYo93gI68T/GRDF/AHuCYHwpygMN/BfBTutWChkz0zMwCeYKBTNYpwobagRLexLobVWCm00SQiEaeJuzhGyZTr+TfLJaWMgSetxX0ifXlEy/xIi4Wna/xUfo7MGf+Aszqcn/YbF3v00cCdJSsKu3bBi6RYqpFwANueBpxsWe40ZmaVYUSNEXAemChVS7vGUjMo/Ge6rQmV25SgP8nmOCzLMH2QkH43weBB/Y2+5vK2E+jQ0O58F6WkbFuWanjxEdx6spMVui9/yHu8WrwDLy42oHg0VYgAAAABJRU5ErkJggg==">
                  <span>Gastos y Desembolsos</span>
               </a>
            </li>
            <li class="sidebar-list">
               <a href="/branch" class="sidebar-link sidebar-title {{ strpos(Request::url(),'Branch') ? 'active' : '' }}" style="cursor: pointer;">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABqklEQVRIicWWL1fDMBTFf3D4CJvdbGcZdvsODAmaWdBFDo9lehoselg2W+ywqwU7RF6WtEva9M/gnpNzbtKmN6+5eXnwTzgpeLYKmP8CPNYRPsv15xY/l49+eebeSOtLfwksQoXzEe+AVyCV/qxEeCx8BLwDt02EL4At0AUSoBPAn2R+sPCpZ/wB+AAGgbwxdsCwxrw5WX+UwhdxjHJ1FMgrI+9qjSVqn9NAXhm+iI8On/AYmKKcG8I30mqjrrkqwxfx3FqEj7vedzUnmiSQe2Ai83qozGXn7QiVQtfW2H7BPlePpc0KeB/4xuTnhOzFskF5QC8stgWauvoTdUNpdFBpc2SNJaj8n0HROU4w59XFbbGpLGDr4W9lEZQZKs9D0+SQAqPZwiHQwvqjIXwP36+OUY69Bq48XCPBnITUw7t5gSa5WkPv8VKaiychwpeYqmNijdvcdm0t5BNISIEHKoIf4XeoYkD/CRfvooqGouIyGEcxVxWsyEbi4gcnpY37OBLxuIAfoI2IU+AZk9FcvHXhCOP2AabizPNem8Ib1N5Ny14UrMtf+QP8AnbkrCcYPXsIAAAAAElFTkSuQmCC" />
                  <span>Sucursales</span>
               </a>
            </li>
            <!-- <li class="sidebar-list">
               <a href="/box" class="sidebar-link sidebar-title {{   in_array(request()->route()->getPrefix(), ['/color-version', '/page-layout'] ) ? 'active' : '' }}">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABnElEQVRIie3Vv0tVYRzH8dfNi5TaD0lEt2yxqFwUlxqKprCppf8h28OhKaolRGgIGpsaq00UozU1iCIcdLckEoUUKmx4ngOn07n3HrnnNth9wwNfnuf5fj/fHzzn0KZNm4PAEJaw94/WIoYqeIYreIifLS6yiim8rqIb21jACg7jXMmCn7CDs7iNLhjDBjZRwYzy2zsTY2/iC0aTjI5gINprDYL8wDSuxjUd9+r5rMXYg0JH/2K4QPZ3cvymCvgNpx0OZQJcy8smw3LO3mIBv7qxZzXOfA49KZ8ezBfwm00LVVJ2F76qMYMMG3gT7cvoK+Czi5P4nj24XiDrZtdEIpaecZH5Nkuuxketr/hDIlZNCd/CmZIqq8VKYlTq3doHfTgvvNVenMBxHEVn6t5bPOLPihOWhA/CXA2RDowL87oYBfvj2S9sCZ/GLeEfsJvyPVYv+8+4m9nrxE08F57cHr7hBe7FswuZ6vbNMp5G+xQeYD2KvcN9XJLfraZ4ifd4JbRuG08wUrZQlsdCdauY1GAuZXIaN7Sglf83vwH9o9BGX2OUtwAAAABJRU5ErkJggg==" />
                  <span>Cajas</span>
               </a>
            </li> -->
         </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
   </nav>
</div>