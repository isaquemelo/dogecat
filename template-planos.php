<?php
/*
 * Template Name: Planos
 * description: >-
 */



if (!is_user_logged_in()){
	auth_redirect();
}

get_header();

$planoAtual = 0;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$planoAtual = $_GET['plano'];
}


?>

<?php
	// melhor
	if ($planoAtual == 1):?>

<table class="table table-striped table-bordered">
    <tr>
        <td colspan="4">PLANO PET PREMIUM</td>
    </tr>
    <tr>
        <td>CONSULTAS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Consultas urgência - emergência</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td></td>
    </tr>
    <tr>
        <td>Consulta clínico geral</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">06</td>
    </tr>
    <tr>
        <td>Consulta especialista</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td></td>
    </tr>
    <tr>
        <td>Atendimento domiciliar</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">02</td>
    </tr>
    <tr>
        <td>VACINAS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Vacina de giárdia</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Gripe canina - dose 1</td>
        <td style="text-align: right">52</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Gripe canina - dose 2</td>
        <td style="text-align: right">74</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Gripe adulto - dose única</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Vacina de raiva</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Vacina polivalente ( V8 ou V10)</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Polivalente (V8 ou V10) reforço 1</td>
        <td style="text-align: right">52</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Polivalente (V8 ou V10) reforço 2</td>
        <td style="text-align: right">74</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Polivalente adulto (V8 ou V10)</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>LIMITE DE USO<br />ANO</td>
    </tr>
    <tr>
        <td>EXAMES LABORATORIAIS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td></td>
    </tr>
    <tr>
        <td>ALT (TGP)</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>AST (TGO)</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Albumina</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Amilase</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Cálcio</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Colesterol</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Coleta por cistocentese (amostra de urina)</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Creatina</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Fosfatase alcalina</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Fósforo</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>GGT</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Glicose</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td colspan="4">Parasitológico de fezes</td>
    </tr>
</table>


<table class="table table-striped table-bordered">
    <tr>
        <td>Potássio</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>PPT</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Uréia</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>OUTROS PROCEDIMENTOS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITAE NDOE USO</td>
    </tr>
    <tr>
        <td>Citologia de pele</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Citologia de ouvido</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Curativo simples</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">03</td>
    </tr>
    <tr>
        <td>Fluidoterapia</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Imobilização simples</td>
        <td style="text-align: right">90</td>
        <td style="text-align: right">90</td>
        <td style="text-align: right">02</td>
    </tr>
    <tr>
        <td>Oxigênio terapia</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Sorológico 4DX</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Satura de pele (simples)</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Satura de pele ( complexo)</td>
        <td style="text-align: right">90</td>
        <td style="text-align: right">90</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Tratamento cirúrgico miíase</td>
        <td style="text-align: right">90</td>
        <td style="text-align: right">90</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>EXAMES DE IMAGENS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Eletrocardiograma</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Raio X simples (sem contraste)</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Ultrasonografia simples</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Ecocardiograma</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>ANESTESIA</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Anestesia inalatória</td>
        <td style="text-align: right">120</td>
        <td style="text-align: right">120</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Anestesia geral injetável</td>
        <td style="text-align: right">120</td>
        <td style="text-align: right">120</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Sedação</td>
        <td style="text-align: right">120</td>
        <td style="text-align: right">120</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>INTERNAÇÃO</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Enfermaria (diária) direito 04 dias</td>
        <td style="text-align: right">180</td>
        <td style="text-align: right">04</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>GENITO URINÁRIO</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Castração fêmea</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Castração macho</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Castração fêmea (patológica - laudo e exame comprobatórios)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Castração macho (patológica - laudo e exame comprobatórios)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Cesariana</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
</table>
<table class="table table-striped table-bordered">
    <tr>
        <td>Cesariana com castração</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Cistotomia (cirurgia de bixiga)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Hérnia inguinal</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Hérnia perineal</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Hérnia humbilical</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Neoplasia perineal</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Neoplasia mamária individual</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Neoplasia mamária cadeia bilateral</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Parto assistido</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Penectomia (retirada do pênis)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Uretrostomia ( cirurgia da uretra)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>ORTOPÉDICO</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Amputação de membros</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Luxação de patela</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Osteossintese com pino</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>OCULARES</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Anexos (pálpebras) entrópio e etrópio uni-lateral</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Enucreação bilateral (retirada dos globos oculares)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Enucleação bilateral (retirada dos globos oculares)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Prolapso de terceira pálpebra (sepultamento)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Redução prolapso globo ocular</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>AURICULARES</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Otohematoma (cirurgia de orelha)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>GERAIS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Enterectomia ( cirurgia no intestino)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Esofagotomia</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Esplemectomia ( cirurgia no baço)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Gastronomia</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Laparotomia exploratória (abertura cav. abdominal)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Taxi dog (10 km da clínica) caso de urgência e emergência)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Traqueostomia</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
</table>
<table class="table table-striped table-bordered">
    <tr>
        <td>BUCO-FACIAIS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Extração de dente de leite</td>
        <td style="text-align: right">180</td>
        <td style="text-align: right">180</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Extração de dente permanente</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Limpeza de tártaro</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Neoplasia gengival (câncer de gengiva)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
</table>










<?php elseif ($planoAtual == 2): ?>


<table class="table table-striped table-bordered">
    <tr>
        <td colspan="4">PLANO PET PLUS</td>
    </tr>
    <tr>
        <td>CONSULTAS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Consultas urgência - emergência</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">04</td>
    </tr>
    <tr>
        <td>Consulta clínico geral</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td></td>
    </tr>
    <tr>
        <td>Atendimento domiciliar</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">02</td>
    </tr>
    <tr>
        <td>VACINAS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Vacina de giárdia</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Gripe canina - dose 1</td>
        <td style="text-align: right">52</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Gripe canina - dose 2</td>
        <td style="text-align: right">74</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Gripe adulto - dose única</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Vacina de raiva</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Vacina polivalente ( V8 ou V10)</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Polivalente (V8 ou V10) reforço 1</td>
        <td style="text-align: right">52</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Polivalente (V8 ou V10) reforço 2</td>
        <td style="text-align: right">74</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Polivalente adulto (V8 ou V10)</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>EXAMES LABORATORIAIS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>ALT (TGP)</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>AST (TGO)</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Albumina</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Amilase</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Cálcio</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Colesterol</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Coleta por cistocentese (amostra de urina)</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Creatina</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Fosfatase alcalina</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Fósforo</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>GGT</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Glicose</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Parasitológico de fezes</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
</table>
<table class="table table-striped table-bordered">
    <tr>
        <td>Potássio</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>PPT</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Uréia</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>OUTROS PROCEDIMENTOS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITAE NDOE USO</td>
    </tr>
    <tr>
        <td>Citologia de pele</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Citologia de ouvido</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Curativo simples</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">30</td>
        <td style="text-align: right">03</td>
    </tr>
    <tr>
        <td>Fluidoterapia</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Imobilização simples</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">180</td>
        <td style="text-align: right">02</td>
    </tr>
    <tr>
        <td>Oxigênio terapia</td>
        <td style="text-align: right">90</td>
        <td style="text-align: right">90</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Sorológico 4DX</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>EXAMES DE IMAGENS</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Eletrocardiograma</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Raio X simples (sem contraste)</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Ultrasonografia simples</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">60</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>GENITO URINÁRIO</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Castração fêmea</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Castração macho</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>Neoplasia mamária individual</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td>AURICULARES</td>
        <td>CARÊNCIA</td>
        <td>PERÍODO/DIAS</td>
        <td>LIMITE DE USOANO</td>
    </tr>
    <tr>
        <td>Otohematoma (cirurgia de orelha)</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">365</td>
        <td style="text-align: right">01</td>
    </tr>
</table>














<?php else: ?>


<table class="table table-striped table-bordered">
    <tr>
        <td></td>
        <td colspan="3">PLANO PET LIGHT</td>
        <td colspan="2"></td>
    </tr>

    <tr>
        <td colspan="2">Fosfatase alcalina</td>
        <td style="text-align: right" colspan="2">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td colspan="2">Fósforo</td>
        <td style="text-align: right" colspan="2">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td colspan="2">GGT</td>
        <td style="text-align: right" colspan="2">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td colspan="2">Glicose</td>
        <td style="text-align: right" colspan="2">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td colspan="2">Parasitológico de fezes</td>
        <td style="text-align: right" colspan="2">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td colspan="2">Potássio</td>
        <td style="text-align: right" colspan="2">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td colspan="2">PPT</td>
        <td style="text-align: right" colspan="2">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
    <tr>
        <td colspan="2">Uréia</td>
        <td style="text-align: right" colspan="2">30</td>
        <td style="text-align: right">21</td>
        <td style="text-align: right">01</td>
    </tr>
</table>



<?php endif; ?>

<?php get_footer(); ?>
