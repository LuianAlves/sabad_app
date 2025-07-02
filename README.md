## ------------> Licenses

- Fazer igual dispositivos, sem quantidade.

## ------------> Chips

# PhoneOperator

- name

# Chips

- company_id
- phone_operator_id

# ChipsControl

- chip_id
- employee_id
- ddd
- number
- delivered_in
- returned_in

## ------------> Heritage - Pratimonio

# HeritageType

* Store apenas na view create de heritage

- name

# HeritageBrand

* Store apenas na view create de heritage

- heritage_type_id
- name

# HeritageModel

* Store apenas na view create de heritage

- heritage_brand_id
- name

# Heritage - OK

- Feito apenas index + create + store

# HeritageControl

- department_id
- heritage_id
- heritage_code
- delivered_in
- returned_in
- estimated_price 
- purchased_in


## ------------> Stock 

# GeneralStock

item_id (relacionar entre heritage ou device)
estimated_price
historic (colocar em json os antigos IDs para rastrear por onde passou)

Estrutura do array/json: historic

    employee_id:
        purchased_in:
        delivered_in:
        returned_in:
        estimated_price:
        conditions:
            condition1:
            condition2:
    employee_id:
        purchased_in:
        delivered_in:
        returned_in:
        estimated_price:
        conditions:
            condition1:
            condition2:
            condition3:


## ----------------------------- ANOTAÇÕES PARA LEMBRAR ----------------------------- ##

# Novo padrão de código:

NOTE0001D
CADE0001H
IMPR0001D
IMPR0001H


# AS CORES PARA <span class="badge badge-sm border border-primary text-info bg-success">

text-primary: cor do texto
border-primary: cor da borda dos elementos
bg-primary: Cor de fundo das coisas 

primary: roxo
success: verde
danger: vermelho
info: azul
warning: laranja
light: cinza claro
dark: cinza escuro (Quase preto)