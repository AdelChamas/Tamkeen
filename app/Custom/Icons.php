<?php
namespace App\Custom;

use App\Models\Assessment;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Discussion;
use App\Models\Lesson;

trait Icons{
    private static $icons = [
        'it' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 19c0 .34.03.67.08 1H6.5c-1.5 0-2.81-.5-3.89-1.57C1.54 17.38 1 16.09 1 14.58c0-1.3.39-2.46 1.17-3.48S4 9.43 5.25 9.15c.42-1.53 1.25-2.77 2.5-3.72S10.42 4 12 4c1.95 0 3.6.68 4.96 2.04C18.32 7.4 19 9.05 19 11c1.15.13 2.1.63 2.86 1.5c.06.05.1.13.14.19c-.9-.44-1.92-.69-3-.69c-3.87 0-7 3.13-7 7m11.83 1.64l-1 1.73c-.07.13-.2.13-.33.13l-1.23-.5c-.27.18-.54.34-.84.47l-.19 1.32c-.02.12-.13.21-.24.21h-2c-.14 0-.24-.09-.26-.21l-.19-1.32c-.31-.12-.59-.29-.85-.47l-1.24.5c-.12 0-.25 0-.31-.13l-1-1.73a.26.26 0 0 1 .06-.32l1.06-.82a4.193 4.193 0 0 1 0-1l-1.06-.82a.248.248 0 0 1-.06-.32l1-1.73c.07-.13.2-.13.31-.13l1.24.5c.26-.18.55-.34.85-.47l.19-1.32A.26.26 0 0 1 18 14h2c.11 0 .22.09.23.21l.19 1.32c.31.12.58.29.85.47l1.23-.5c.13 0 .26 0 .32.13l1 1.73c.06.11.03.24-.06.32l-1.06.82c.03.17.04.33.04.5s-.02.33-.04.5l1.07.82c.09.08.12.21.06.32M20.5 19c0-.83-.68-1.5-1.5-1.5s-1.5.67-1.5 1.5s.66 1.5 1.5 1.5s1.5-.67 1.5-1.5Z"/></svg>',
        'graphic design' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M10.847 21.934C5.867 21.362 2 17.133 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.157-3.283 4.733-6.086 4.37c-1.618-.209-3.075-.397-3.652.518c-.395.626.032 1.406.555 1.929a1.673 1.673 0 0 1 0 2.366c-.523.523-1.235.836-1.97.751ZM11.085 7a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0ZM6.5 13a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Zm11 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Zm-3-4.5a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd"/></svg>',
        'business' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 21q-.825 0-1.413-.588T2 19V8q0-.825.588-1.413T4 6h4V4q0-.825.588-1.413T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.588 1.413T20 21H4Zm6-15h4V4h-4v2Zm10 9h-5v1q0 .425-.288.713T14 17h-4q-.425 0-.713-.288T9 16v-1H4v4h16v-4Zm-9 0h2v-2h-2v2Zm-7-2h5v-1q0-.425.288-.713T10 11h4q.425 0 .713.288T15 12v1h5V8H4v5Zm8 1Z"/></svg>',
        'programming' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3.464 3.464C2 4.93 2 7.286 2 12c0 4.714 0 7.071 1.464 8.535C4.93 22 7.286 22 12 22c4.714 0 7.071 0 8.535-1.465C22 19.072 22 16.714 22 12s0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464Zm2.96 6.056a.75.75 0 0 1 1.056-.096l.277.23c.605.504 1.12.933 1.476 1.328c.379.42.674.901.674 1.518s-.295 1.099-.674 1.518c-.356.395-.871.824-1.476 1.328l-.277.23a.75.75 0 1 1-.96-1.152l.234-.195c.659-.55 1.09-.91 1.366-1.216c.262-.29.287-.427.287-.513c0-.086-.025-.222-.287-.513c-.277-.306-.707-.667-1.366-1.216l-.234-.195a.75.75 0 0 1-.096-1.056ZM17.75 15a.75.75 0 0 1-.75.75h-5a.75.75 0 0 1 0-1.5h5a.75.75 0 0 1 .75.75Z" clip-rule="evenodd"/></svg>'
    ];
    public static function getIcon($category_name){
        return static::$icons[$category_name];
    }
}