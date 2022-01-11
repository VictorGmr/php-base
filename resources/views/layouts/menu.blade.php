<!-- need to remove -->
<li class="nav-item">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Pessoa
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('pessoa-create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cadastrar</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('pessoa-list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Listar</p>
            </a>
        </li>
    </ul>
</li>
