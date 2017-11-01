@extends('layouts.attendance')
@section('content')
    <table class="table">
        <tr>
            <th>Allow Menu Settings</th>
        </tr>
        <tr>
            <th>MENU</th>
            <th>ALLOWED</th>
            <th>NOT ALLOWED</th>
            <th>STATUS</th>
        </tr>
        <tr>
            <td>Update Subject</td>
            <td><button>Allow</button></td>
            <td><button>Prohibit</button></td>
            <td></td>
        </tr>
        <tr>
            <td>Delete Subject</td>
            <td><button>Allow</button></td>
            <td><button>Prohibit</button></td>
            <td></td>
        </tr>
        <tr>
            <td>Delete Student</td>
            <td><button>Allow</button></td>
            <td><button>Prohibit</button></td>
            <td></td>
        </tr>
        <tr>
            <td>View Elective</td>
            <td><button>Allow</button></td>
            <td><button>Prohibit</button></td>
            <td></td>
        </tr>
        <tr>
            <td>Add Subject</td>
            <td><button>Allow</button></td>
            <td><button>Prohibit</button></td>
            <td></td>
        </tr>
        <tr>
            <td>AssignRole</td>
            <td><button>Allow</button></td>
            <td><button>Prohibit</button></td>
            <td></td>
        </tr>
        <tr>
            <td>AssignElective</td>
            <td><button>Allow</button></td>
            <td><button>Prohibit</button></td>
            <td></td>
        </tr>
        <tr>
            <td>Add Student</td>
            <td><button>Allow</button></td>
            <td><button>Prohibit</button></td>
            <td></td>
        </tr>
    </table>
@endsection