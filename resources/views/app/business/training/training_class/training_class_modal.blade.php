<div class="modal" id="emailModal">
    <div class="modal-dialog">
        <form id="emailForm" method="POST">
            @csrf
            <div class="mb-2">
                <small>Variáveis:</small>
                <button type="button" class="insert-var" data-var="{COLABORADOR}">{COLABORADOR}</button>
                <button type="button" class="insert-var" data-var="{TREINAMENTO}">{TREINAMENTO}</button>
                <button type="button" class="insert-var" data-var="{DATA_TREINAMENTO}">{DATA_TREINAMENTO}</button>
            </div>
            <textarea id="templateTextarea" name="template" class="form-control" style="height:120px"></textarea>
            <button class="btn btn-primary mt-2">Enviar</button>
        </form>
    </div>
</div>
<script>
    document.querySelectorAll('.btn-open-email').forEach(btn=>{
        btn.addEventListener('click',e=>{
            const id = btn.dataset.id;
            document.getElementById('emailForm').action = `/turmas/${id}/email`;
            document.getElementById('templateTextarea').value = btn.dataset.template;
            new bootstrap.Modal(document.getElementById('emailModal')).show();
        });
    });
    document.querySelectorAll('.insert-var').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const ta = document.getElementById('templateTextarea');
            const v = btn.dataset.var;
            const start = ta.selectionStart;
            const end = ta.selectionEnd;
            ta.value = ta.value.slice(0, start) + v + ta.value.slice(end);
            ta.setSelectionRange(start + v.length, start + v.length);
            ta.focus();
        });
    });
</script>}]}
